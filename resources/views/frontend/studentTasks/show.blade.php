@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.studentTask.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.student-tasks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $studentTask->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $studentTask->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.task') }}
                                    </th>
                                    <td>
                                        {{ $studentTask->task }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.details') }}
                                    </th>
                                    <td>
                                        {!! $studentTask->details !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.files') }}
                                    </th>
                                    <td>
                                        @foreach($studentTask->files as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.studentTask.fields.students') }}
                                    </th>
                                    <td>
                                        @foreach($studentTask->students as $key => $students)
                                            <span class="label label-info">{{ $students->sessions_start_date }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.student-tasks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection