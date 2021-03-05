@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.staffAttendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.staff-attendances.update", [$staffAttendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.staffAttendance.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $employee)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $staffAttendance->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $employee }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staffAttendance.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.staffAttendance.fields.status') }}</label>
                @foreach(App\Models\StaffAttendance::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $staffAttendance->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staffAttendance.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.staffAttendance.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $staffAttendance->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staffAttendance.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.staffAttendance.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $staffAttendance->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staffAttendance.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="taken_by_id">{{ trans('cruds.staffAttendance.fields.taken_by') }}</label>
                <select class="form-control select2 {{ $errors->has('taken_by') ? 'is-invalid' : '' }}" name="taken_by_id" id="taken_by_id">
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



@endsection