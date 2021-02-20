@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('staff_notification_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.staff-notifications.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.staffNotification.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.staffNotification.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-StaffNotification">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.publish_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.valid_till') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staffNotification.fields.staff_members') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffNotifications as $key => $staffNotification)
                                    <tr data-entry-id="{{ $staffNotification->id }}">
                                        <td>
                                            {{ $staffNotification->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffNotification->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffNotification->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffNotification->publish_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staffNotification->valid_till ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($staffNotification->staff_members as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('staff_notification_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.staff-notifications.show', $staffNotification->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('staff_notification_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.staff-notifications.edit', $staffNotification->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('staff_notification_delete')
                                                <form action="{{ route('frontend.staff-notifications.destroy', $staffNotification->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('staff_notification_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.staff-notifications.massDestroy') }}",
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
  let table = $('.datatable-StaffNotification:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection