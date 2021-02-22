@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.certificate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.certificates.update", [$certificate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="certificate_number">{{ trans('cruds.certificate.fields.certificate_number') }}</label>
                <input class="form-control {{ $errors->has('certificate_number') ? 'is-invalid' : '' }}" type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number', $certificate->certificate_number) }}" required>
                @if($errors->has('certificate_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificate_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.certificate_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.certificate.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $student)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $certificate->student->id ?? '') == $id ? 'selected' : '' }}>{{ $student }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.student_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="course_batch_session_id">{{ trans('cruds.certificate.fields.course_batch_session') }}</label>
                <select class="form-control select2 {{ $errors->has('course_batch_session') ? 'is-invalid' : '' }}" name="course_batch_session_id" id="course_batch_session_id">
                    @foreach($course_batch_sessions as $id => $course_batch_session)
                        <option value="{{ $id }}" {{ (old('course_batch_session_id') ? old('course_batch_session_id') : $certificate->course_batch_session->id ?? '') == $id ? 'selected' : '' }}>{{ $course_batch_session }}</option>
                    @endforeach
                </select>
                @if($errors->has('course_batch_session'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course_batch_session') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.course_batch_session_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="grade">{{ trans('cruds.certificate.fields.grade') }}</label>
                <input class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" type="text" name="grade" id="grade" value="{{ old('grade', $certificate->grade) }}">
                @if($errors->has('grade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('grade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.grade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.certificate.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $certificate->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.comment_helper') }}</span>
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