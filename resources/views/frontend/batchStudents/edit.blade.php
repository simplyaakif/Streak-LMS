@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.batchStudent.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.batch-students.update", [$batchStudent->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="batch_id">{{ trans('cruds.batchStudent.fields.batch') }}</label>
                            <select class="form-control select2" name="batch_id" id="batch_id" required>
                                @foreach($batches as $id => $batch)
                                    <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $batchStudent->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $batch }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('batch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('batch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchStudent.fields.batch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_id">{{ trans('cruds.batchStudent.fields.student') }}</label>
                            <select class="form-control select2" name="student_id" id="student_id" required>
                                @foreach($students as $id => $student)
                                    <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $batchStudent->student->id ?? '') == $id ? 'selected' : '' }}>{{ $student }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchStudent.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sessions_start_date">{{ trans('cruds.batchStudent.fields.sessions_start_date') }}</label>
                            <input class="form-control date" type="text" name="sessions_start_date" id="sessions_start_date" value="{{ old('sessions_start_date', $batchStudent->sessions_start_date) }}" required>
                            @if($errors->has('sessions_start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sessions_start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchStudent.fields.sessions_start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="session_end_date">{{ trans('cruds.batchStudent.fields.session_end_date') }}</label>
                            <input class="form-control date" type="text" name="session_end_date" id="session_end_date" value="{{ old('session_end_date', $batchStudent->session_end_date) }}" required>
                            @if($errors->has('session_end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('session_end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchStudent.fields.session_end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_status_id">{{ trans('cruds.batchStudent.fields.student_status') }}</label>
                            <select class="form-control select2" name="student_status_id" id="student_status_id" required>
                                @foreach($student_statuses as $id => $student_status)
                                    <option value="{{ $id }}" {{ (old('student_status_id') ? old('student_status_id') : $batchStudent->student_status->id ?? '') == $id ? 'selected' : '' }}>{{ $student_status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('student_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchStudent.fields.student_status_helper') }}</span>
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