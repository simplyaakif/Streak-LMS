@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('course_material_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.course-materials.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.courseMaterial.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.courseMaterial.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CourseMaterial">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.course') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.batch') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.chapter_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.chapter_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.content') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.courseMaterial.fields.position') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courseMaterials as $key => $courseMaterial)
                                    <tr data-entry-id="{{ $courseMaterial->id }}">
                                        <td>
                                            {{ $courseMaterial->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $courseMaterial->course->title ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($courseMaterial->batches as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $courseMaterial->chapter_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $courseMaterial->chapter_name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($courseMaterial->content as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $courseMaterial->position ?? '' }}
                                        </td>
                                        <td>
                                            @can('course_material_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.course-materials.show', $courseMaterial->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('course_material_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.course-materials.edit', $courseMaterial->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('course_material_delete')
                                                <form action="{{ route('frontend.course-materials.destroy', $courseMaterial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('course_material_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.course-materials.massDestroy') }}",
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
  let table = $('.datatable-CourseMaterial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection