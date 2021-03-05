@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.staffAttendance.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.staff-attendances.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $staffAttendance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $staffAttendance->employee->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\StaffAttendance::STATUS_RADIO[$staffAttendance->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $staffAttendance->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.comment') }}
                                    </th>
                                    <td>
                                        {{ $staffAttendance->comment }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staffAttendance.fields.taken_by') }}
                                    </th>
                                    <td>
                                        {{ $staffAttendance->taken_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.staff-attendances.index') }}">
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