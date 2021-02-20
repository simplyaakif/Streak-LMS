@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dailyLessonPlanner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-lesson-planners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.id') }}
                        </th>
                        <td>
                            {{ $dailyLessonPlanner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.user') }}
                        </th>
                        <td>
                            {{ $dailyLessonPlanner->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.title') }}
                        </th>
                        <td>
                            {{ $dailyLessonPlanner->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.description') }}
                        </th>
                        <td>
                            {!! $dailyLessonPlanner->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.files') }}
                        </th>
                        <td>
                            @if($dailyLessonPlanner->files)
                                <a href="{{ $dailyLessonPlanner->files->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyLessonPlanner.fields.batch') }}
                        </th>
                        <td>
                            {{ $dailyLessonPlanner->batch->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-lesson-planners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection