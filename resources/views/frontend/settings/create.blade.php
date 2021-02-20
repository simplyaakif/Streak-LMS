@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.settings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="key">{{ trans('cruds.setting.fields.key') }}</label>
                            <input class="form-control" type="text" name="key" id="key" value="{{ old('key', '') }}">
                            @if($errors->has('key'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('key') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.key_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="value">{{ trans('cruds.setting.fields.value') }}</label>
                            <textarea class="form-control" name="value" id="value">{{ old('value') }}</textarea>
                            @if($errors->has('value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.value_helper') }}</span>
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