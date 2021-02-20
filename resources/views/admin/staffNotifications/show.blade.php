@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.staffNotification.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staff-notifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.id') }}
                        </th>
                        <td>
                            {{ $staffNotification->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.title') }}
                        </th>
                        <td>
                            {{ $staffNotification->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.description') }}
                        </th>
                        <td>
                            {{ $staffNotification->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.publish_at') }}
                        </th>
                        <td>
                            {{ $staffNotification->publish_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.valid_till') }}
                        </th>
                        <td>
                            {{ $staffNotification->valid_till }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staffNotification.fields.staff_members') }}
                        </th>
                        <td>
                            @foreach($staffNotification->staff_members as $key => $staff_members)
                                <span class="label label-info">{{ $staff_members->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staff-notifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection