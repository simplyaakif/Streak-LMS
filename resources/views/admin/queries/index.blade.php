@extends('layouts.admin')
@section('content')
@can('query_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.queries.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Query">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('query_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.queries.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.queries.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'mobile_number', name: 'mobile_number' },
{ data: 'email', name: 'email' },
{ data: 'courses', name: 'courses.title' },
{ data: 'dealt_by_name', name: 'dealt_by.name' },
{ data: 'address', name: 'address' },
{ data: 'comments_remarks', name: 'comments_remarks' },
{ data: 'interaction_type_title', name: 'interaction_type.title' },
{ data: 'status_title', name: 'status.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Query').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection