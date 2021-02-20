@extends('layouts.admin')
@section('content')
@can('batch_student_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.batch-students.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.batchStudent.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BatchStudent', 'route' => 'admin.batch-students.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.batchStudent.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BatchStudent">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.batch') }}
                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.student') }}
                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.sessions_start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.session_end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.batchStudent.fields.student_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.studentStatus.fields.comments') }}
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
@can('batch_student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.batch-students.massDestroy') }}",
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
    ajax: "{{ route('admin.batch-students.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'batch_title', name: 'batch.title' },
{ data: 'student_name', name: 'student.name' },
{ data: 'sessions_start_date', name: 'sessions_start_date' },
{ data: 'session_end_date', name: 'session_end_date' },
{ data: 'student_status_status_title', name: 'student_status.status_title' },
{ data: 'student_status.comments', name: 'student_status.comments' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BatchStudent').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection