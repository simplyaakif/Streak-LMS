@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseMaterial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.id') }}
                        </th>
                        <td>
                            {{ $courseMaterial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.course') }}
                        </th>
                        <td>
                            {{ $courseMaterial->course->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.batch') }}
                        </th>
                        <td>
                            @foreach($courseMaterial->batches as $key => $batch)
                                <span class="label label-info">{{ $batch->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.chapter_number') }}
                        </th>
                        <td>
                            {{ $courseMaterial->chapter_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.chapter_name') }}
                        </th>
                        <td>
                            {{ $courseMaterial->chapter_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.chapter_details') }}
                        </th>
                        <td>
                            {!! $courseMaterial->chapter_details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.content') }}
                        </th>
                        <td>
                            @foreach($courseMaterial->content as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseMaterial.fields.position') }}
                        </th>
                        <td>
                            {{ $courseMaterial->position }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection