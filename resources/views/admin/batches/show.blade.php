@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.batch.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.batches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.id') }}
                        </th>
                        <td>
                            {{ $batch->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.title') }}
                        </th>
                        <td>
                            {{ $batch->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.course') }}
                        </th>
                        <td>
                            {{ $batch->course->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.class_time') }}
                        </th>
                        <td>
                            {{ $batch->class_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.strength') }}
                        </th>
                        <td>
                            {{ $batch->strength }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.batch_content') }}
                        </th>
                        <td>
                            @foreach($batch->batch_content as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.instructor') }}
                        </th>
                        <td>
                            @foreach($batch->instructors as $key => $instructor)
                                <span class="label label-info">{{ $instructor->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.description') }}
                        </th>
                        <td>
                            {!! $batch->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.batch_thumbnail') }}
                        </th>
                        <td>
                            @if($batch->batch_thumbnail)
                                <a href="{{ $batch->batch_thumbnail->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $batch->batch_thumbnail->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.batches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection