@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('query_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.queries.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.query.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Query', 'route' => 'admin.queries.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.query.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Query">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.query.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.mobile_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.courses') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.dealt_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.comments_remarks') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.interaction_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.query.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queries as $key => $query)
                                    <tr data-entry-id="{{ $query->id }}">
                                        <td>
                                            {{ $query->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->mobile_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->email ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($query->courses as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $query->dealt_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->comments_remarks ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->interaction_type->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $query->status->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('query_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.queries.show', $query->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('query_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.queries.edit', $query->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('query_delete')
                                                <form action="{{ route('frontend.queries.destroy', $query->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('query_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.queries.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Query:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection