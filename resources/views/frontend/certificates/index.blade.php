@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('certificate_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.certificates.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.certificate.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.certificate.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Certificate">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificate.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificate.fields.certificate_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificate.fields.student') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificate.fields.course_batch_session') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificate.fields.grade') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificate.fields.comment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificates as $key => $certificate)
                                    <tr data-entry-id="{{ $certificate->id }}">
                                        <td>
                                            {{ $certificate->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificate->certificate_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificate->student->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificate->course_batch_session->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificate->grade ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificate->comment ?? '' }}
                                        </td>
                                        <td>
                                            @can('certificate_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.certificates.show', $certificate->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('certificate_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.certificates.edit', $certificate->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('certificate_delete')
                                                <form action="{{ route('frontend.certificates.destroy', $certificate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('certificate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.certificates.massDestroy') }}",
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
  let table = $('.datatable-Certificate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection