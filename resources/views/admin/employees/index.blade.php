@extends('layouts.admin')
@section('content')
@can('employee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employees.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employee.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Employee">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.dp') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.date_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.marital_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.job_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.cnic_passport') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.qualification') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.experience') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.relegion') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.documents_cv_experience') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.earning_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.basic_salary') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.medical') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.conveyance') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.deduction_leave') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.deduction_loan') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.deduction_tax') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.deduction_other') }}
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
@can('employee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employees.massDestroy') }}",
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
    ajax: "{{ route('admin.employees.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'dp', name: 'dp', sortable: false, searchable: false },
{ data: 'user_name', name: 'user.name' },
{ data: 'mobile', name: 'mobile' },
{ data: 'email', name: 'email' },
{ data: 'address', name: 'address' },
{ data: 'city', name: 'city' },
{ data: 'date_of_birth', name: 'date_of_birth' },
{ data: 'gender', name: 'gender' },
{ data: 'marital_status', name: 'marital_status' },
{ data: 'job_title', name: 'job_title' },
{ data: 'cnic_passport', name: 'cnic_passport' },
{ data: 'qualification', name: 'qualification' },
{ data: 'experience', name: 'experience' },
{ data: 'relegion', name: 'relegion' },
{ data: 'documents_cv_experience', name: 'documents_cv_experience', sortable: false, searchable: false },
{ data: 'earning_type', name: 'earning_type' },
{ data: 'basic_salary', name: 'basic_salary' },
{ data: 'medical', name: 'medical' },
{ data: 'conveyance', name: 'conveyance' },
{ data: 'deduction_leave', name: 'deduction_leave' },
{ data: 'deduction_loan', name: 'deduction_loan' },
{ data: 'deduction_tax', name: 'deduction_tax' },
{ data: 'deduction_other', name: 'deduction_other' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Employee').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection