@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('batch_notification_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.batch-notifications.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.batchNotification.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.batchNotification.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BatchNotification">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.batches') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.publish_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.valid_till') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batchNotifications as $key => $batchNotification)
                                    <tr data-entry-id="{{ $batchNotification->id }}">
                                        <td>
                                            {{ $batchNotification->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($batchNotification->batches as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $batchNotification->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batchNotification->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batchNotification->publish_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batchNotification->valid_till ?? '' }}
                                        </td>
                                        <td>
                                            @can('batch_notification_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.batch-notifications.show', $batchNotification->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('batch_notification_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.batch-notifications.edit', $batchNotification->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('batch_notification_delete')
                                                <form action="{{ route('frontend.batch-notifications.destroy', $batchNotification->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('batch_notification_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.batch-notifications.massDestroy') }}",
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
  let table = $('.datatable-BatchNotification:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection