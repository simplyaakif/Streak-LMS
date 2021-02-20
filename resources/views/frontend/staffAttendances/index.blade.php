@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('staff_attendance_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.staff-attendances.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.staffAttendance.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.staffAttendance.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-StaffAttendance">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.batch') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.student') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.comment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.taken_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffAttendances as $key => $staffAttendance)
                                    <tr data-entry-id="{{ $staffAttendance->id }}">
                                        <td>
                                            {{ $staffAttendance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffAttendance->batch->title ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($staffAttendance->students as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $staffAttendance->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffAttendance->comment ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffAttendance->taken_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('staff_attendance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.staff-attendances.show', $staffAttendance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('staff_attendance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.staff-attendances.edit', $staffAttendance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('staff_attendance_delete')
                                                <form action="{{ route('frontend.staff-attendances.destroy', $staffAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('staff_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.staff-attendances.massDestroy') }}",
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
  let table = $('.datatable-StaffAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection