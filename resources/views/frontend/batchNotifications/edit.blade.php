@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.batchNotification.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.batch-notifications.update", [$batchNotification->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="batches">{{ trans('cruds.batchNotification.fields.batches') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="batches[]" id="batches" multiple>
                                @foreach($batches as $id => $batches)
                                    <option value="{{ $id }}" {{ (in_array($id, old('batches', [])) || $batchNotification->batches->contains($id)) ? 'selected' : '' }}>{{ $batches }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('batches'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('batches') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchNotification.fields.batches_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.batchNotification.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $batchNotification->title) }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchNotification.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.batchNotification.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $batchNotification->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchNotification.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="publish_at">{{ trans('cruds.batchNotification.fields.publish_at') }}</label>
                            <input class="form-control date" type="text" name="publish_at" id="publish_at" value="{{ old('publish_at', $batchNotification->publish_at) }}">
                            @if($errors->has('publish_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('publish_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchNotification.fields.publish_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="valid_till">{{ trans('cruds.batchNotification.fields.valid_till') }}</label>
                            <input class="form-control date" type="text" name="valid_till" id="valid_till" value="{{ old('valid_till', $batchNotification->valid_till) }}">
                            @if($errors->has('valid_till'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('valid_till') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.batchNotification.fields.valid_till_helper') }}</span>
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