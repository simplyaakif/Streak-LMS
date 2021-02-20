@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.course.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.courses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $course->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $course->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $course->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.course_duration') }}
                                    </th>
                                    <td>
                                        {{ $course->course_duration->duration ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.fee') }}
                                    </th>
                                    <td>
                                        {{ $course->fee }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.course_content') }}
                                    </th>
                                    <td>
                                        @foreach($course->course_content as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.thumbnail') }}
                                    </th>
                                    <td>
                                        @if($course->thumbnail)
                                            <a href="{{ $course->thumbnail->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $course->thumbnail->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.courses.index') }}">
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