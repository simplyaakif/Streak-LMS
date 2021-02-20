@extends('layouts.admin')
@section('content')
@can('recovery_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.recoveries.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.recovery.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.recovery.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Recovery">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.student') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.batch') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.is_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.paid_on') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.payment_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.reference_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.recovery.fields.comments') }}
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
@can('recovery_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.recoveries.massDestroy') }}",
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
    ajax: "{{ route('admin.recoveries.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'student_name', name: 'student.name' },
{ data: 'batch_title', name: 'batch.title' },
{ data: 'amount', name: 'amount' },
{ data: 'is_paid', name: 'is_paid' },
{ data: 'paid_on', name: 'paid_on' },
{ data: 'payment_type_title', name: 'payment_type.title' },
{ data: 'reference_number', name: 'reference_number' },
{ data: 'comments', name: 'comments' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Recovery').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection