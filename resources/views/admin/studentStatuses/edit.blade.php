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