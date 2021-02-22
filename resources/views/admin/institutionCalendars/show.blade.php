@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.institutionCalendar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.institution-calendars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.institutionCalendar.fields.id') }}
                        </th>
                        <td>
                            {{ $institutionCalendar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institutionCalendar.fields.title') }}
                        </th>
                        <td>
                            {{ $institutionCalendar->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institutionCalendar.fields.description') }}
                        </th>
                        <td>
                            {{ $institutionCalendar->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.institutionCalendar.fields.date') }}
                        </th>
                        <td>
                            {{ $institutionCalendar->date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.institution-calendars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection