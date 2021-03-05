@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.batchAttendance.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.batch-attendances.update", [$batchAttendance->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="batch_id">{{ trans('cruds.batchAttendance.fields.batch') }}</label>
                            <select class="form-control select2" name="batch_id" id="batch_id" required>
                                @foreach($batches as $id => $batch)
                                    <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $batchAttendance->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $batch }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('batch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('batch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchAttendance.fields.batch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="students">{{ trans('cruds.batchAttendance.fields.student') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="students[]" id="students" multiple required>
                                @foreach($students as $id => $student)
                                    <option value="{{ $id }}" {{ (in_array($id, old('students', [])) || $batchAttendance->students->contains($id)) ? 'selected' : '' }}>{{ $student }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('students'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('students') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchAttendance.fields.student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.batchAttendance.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $batchAttendance->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchAttendance.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.batchAttendance.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment', $batchAttendance->comment) }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchAttendance.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.batchAttendance.fields.status') }}</label>
                            @foreach(App\Models\BatchAttendance::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $batchAttendance->status) === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchAttendance.fields.status_helper') }}</span>
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