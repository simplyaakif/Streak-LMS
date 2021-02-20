@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('daily_lesson_planner_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.daily-lesson-planners.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.dailyLessonPlanner.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dailyLessonPlanner.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-DailyLessonPlanner">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dailyLessonPlanner.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dailyLessonPlanner.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dailyLessonPlanner.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dailyLessonPlanner.fields.files') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dailyLessonPlanner.fields.batch') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dailyLessonPlanners as $key => $dailyLessonPlanner)
                                    <tr data-entry-id="{{ $dailyLessonPlanner->id }}">
                                        <td>
                                            {{ $dailyLessonPlanner->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dailyLessonPlanner->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dailyLessonPlanner->title ?? '' }}
                                        </td>
                                        <td>
                                            @if($dailyLessonPlanner->files)
                                                <a href="{{ $dailyLessonPlanner->files->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $dailyLessonPlanner->batch->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('daily_lesson_planner_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.daily-lesson-planners.show', $dailyLessonPlanner->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('daily_lesson_planner_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.daily-lesson-planners.edit', $dailyLessonPlanner->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('daily_lesson_planner_delete')
                                                <form action="{{ route('frontend.daily-lesson-planners.destroy', $dailyLessonPlanner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('daily_lesson_planner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.daily-lesson-planners.massDestroy') }}",
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
  let table = $('.datatable-DailyLessonPlanner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection