@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.studentStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.student-statuses.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="status_title">{{ trans('cruds.studentStatus.fields.status_title') }}</label>
                            <input class="form-control" type="text" name="status_title" id="status_title" value="{{ old('status_title', '') }}" required>
                            @if($errors->has('status_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.studentStatus.fields.status_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.studentStatus.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.studentStatus.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.studentStatus.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.studentStatus.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comments">{{ trans('cruds.studentStatus.fields.comments') }}</label>
                            <textarea class="form-control" name="comments" id="comments">{{ old('comments') }}</textarea>
                            @if($errors->has('comments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.studentStatus.fields.comments_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection