@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $studentStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentStatus.fields.status_title') }}
                        </th>
                        <td>
                            {{ $studentStatus->status_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentStatus.fields.start_date') }}
                        </th>
                        <td>
                            {{ $studentStatus->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentStatus.fields.end_date') }}
                        </th>
                        <td>
                            {{ $studentStatus->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentStatus.fields.comments') }}
                        </th>
                        <td>
                            {{ $studentStatus->comments }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection