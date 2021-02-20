@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.recovery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.recoveries.update", [$recovery->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="student_id">{{ trans('cruds.recovery.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($students as $id => $student)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $recovery->student->id ?? '') == $id ? 'selected' : '' }}>{{ $student }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.student_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batch_id">{{ trans('cruds.recovery.fields.batch') }}</label>
                <select class="form-control select2 {{ $errors->has('batch') ? 'is-invalid' : '' }}" name="batch_id" id="batch_id">
                    @foreach($batches as $id => $batch)
                        <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $recovery->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $batch }}</option>
                    @endforeach
                </select>
                @if($errors->has('batch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.batch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.recovery.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $recovery->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.recovery.fields.is_paid') }}</label>
                @foreach(App\Models\Recovery::IS_PAID_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_paid') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_paid_{{ $key }}" name="is_paid" value="{{ $key }}" {{ old('is_paid', $recovery->is_paid) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_paid_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.is_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paid_on">{{ trans('cruds.recovery.fields.paid_on') }}</label>
                <input class="form-control date {{ $errors->has('paid_on') ? 'is-invalid' : '' }}" type="text" name="paid_on" id="paid_on" value="{{ old('paid_on', $recovery->paid_on) }}">
                @if($errors->has('paid_on'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid_on') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.paid_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_type_id">{{ trans('cruds.recovery.fields.payment_type') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_type') ? 'is-invalid' : '' }}" name="payment_type_id" id="payment_type_id">
                    @foreach($payment_types as $id => $payment_type)
                        <option value="{{ $id }}" {{ (old('payment_type_id') ? old('payment_type_id') : $recovery->payment_type->id ?? '') == $id ? 'selected' : '' }}>{{ $payment_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.payment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_number">{{ trans('cruds.recovery.fields.reference_number') }}</label>
                <input class="form-control {{ $errors->has('reference_number') ? 'is-invalid' : '' }}" type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', $recovery->reference_number) }}">
                @if($errors->has('reference_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.reference_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comments">{{ trans('cruds.recovery.fields.comments') }}</label>
                <textarea class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" name="comments" id="comments">{{ old('comments', $recovery->comments) }}</textarea>
                @if($errors->has('comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recovery.fields.comments_helper') }}</span>
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