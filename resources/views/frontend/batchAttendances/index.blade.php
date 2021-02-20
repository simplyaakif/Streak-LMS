@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('batch_attendance_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.batch-attendances.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.batchAttendance.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.batchAttendance.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BatchAttendance">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.batch') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.student') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.comment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batchAttendances as $key => $batchAttendance)
                                    <tr data-entry-id="{{ $batchAttendance->id }}">
                                        <td>
                                            {{ $batchAttendance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batchAttendance->batch->title ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($batchAttendance->students as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $batchAttendance->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batchAttendance->comment ?? '' }}
                                        </td>
                                        <td>
                                            @can('batch_attendance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.batch-attendances.show', $batchAttendance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('batch_attendance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.batch-attendances.edit', $batchAttendance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('batch_attendance_delete')
                                                <form action="{{ route('frontend.batch-attendances.destroy', $batchAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('batch_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.batch-attendances.massDestroy') }}",
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
  let table = $('.datatable-BatchAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection