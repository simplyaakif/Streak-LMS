@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.student-statuses.update", [$studentStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="status_title">{{ trans('cruds.studentStatus.fields.status_title') }}</label>
                <input class="form-control {{ $errors->has('status_title') ? 'is-invalid' : '' }}" type="text" name="status_title" id="status_title" value="{{ old('status_title', $studentStatus->status_title) }}" required>
                @if($errors->has('status_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentStatus.fields.status_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.studentStatus.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $studentStatus->start_date) }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentStatus.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.studentStatus.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $studentStatus->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.studentStatus.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comments">{{ trans('cruds.studentStatus.fields.comments') }}</label>
                <textarea class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" name="comments" id="comments">{{ old('comments', $studentStatus->comments) }}</textarea>
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



@endsection