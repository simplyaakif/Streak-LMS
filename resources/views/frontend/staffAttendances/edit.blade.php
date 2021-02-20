@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.staffAttendance.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.staff-attendances.update", [$staffAttendance->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="batch_id">{{ trans('cruds.staffAttendance.fields.batch') }}</label>
                            <select class="form-control select2" name="batch_id" id="batch_id" required>
                                @foreach($batches as $id => $batch)
                                    <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $staffAttendance->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $batch }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('batch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('batch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffAttendance.fields.batch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="students">{{ trans('cruds.staffAttendance.fields.student') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="students[]" id="students" multiple required>
                                @foreach($students as $id => $student)
                                    <option value="{{ $id }}" {{ (in_array($id, old('students', [])) || $staffAttendance->students->contains($id)) ? 'selected' : '' }}>{{ $student }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('students'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('students') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffAttendance.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.staffAttendance.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $staffAttendance->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffAttendance.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.staffAttendance.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment', $staffAttendance->comment) }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffAttendance.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="taken_by_id">{{ trans('cruds.staffAttendance.fields.taken_by') }}</label>
                            <select class="form-control select2" name="taken_by_id" id="taken_by_id">
                                @foreach($taken_bies as $id => $taken_by)
                                    <option value="{{ $id }}" {{ (old('taken_by_id') ? old('taken_by_id') : $staffAttendance->taken_by->id ?? '') == $id ? 'selected' : '' }}>{{ $taken_by }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('taken_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('taken_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffAttendance.fields.taken_by_helper') }}</span>
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