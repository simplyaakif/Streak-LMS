@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.batchNotification.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-notifications.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $batchNotification->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.batches') }}
                                    </th>
                                    <td>
                                        @foreach($batchNotification->batches as $key => $batches)
                                            <span class="label label-info">{{ $batches->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $batchNotification->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $batchNotification->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.publish_at') }}
                                    </th>
                                    <td>
                                        {{ $batchNotification->publish_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchNotification.fields.valid_till') }}
                                    </th>
                                    <td>
                                        {{ $batchNotification->valid_till }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-notifications.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection