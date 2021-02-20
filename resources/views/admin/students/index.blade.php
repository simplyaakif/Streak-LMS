@extends('layouts.admin')
@section('content')
@can('student_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.students.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.student.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Student', 'route' => 'admin.students.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.student.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Student">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.student.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.dp') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.father_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.nationality') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.place_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.first_language') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.date_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.cnic_passport') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.landline') }}
                    </th>
                    <th>
                        {{ trans('cruds.student.fields.admission_form') }}
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
@can('student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.students.massDestroy') }}",
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
    ajax: "{{ route('admin.students.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'dp', name: 'dp', sortable: false, searchable: false },
{ data: 'name', name: 'name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'father_name', name: 'father_name' },
{ data: 'gender', name: 'gender' },
{ data: 'nationality', name: 'nationality' },
{ data: 'place_of_birth', name: 'place_of_birth' },
{ data: 'first_language', name: 'first_language' },
{ data: 'date_of_birth', name: 'date_of_birth' },
{ data: 'cnic_passport', name: 'cnic_passport' },
{ data: 'mobile', name: 'mobile' },
{ data: 'email', name: 'email' },
{ data: 'landline', name: 'landline' },
{ data: 'admission_form', name: 'admission_form', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Student').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection