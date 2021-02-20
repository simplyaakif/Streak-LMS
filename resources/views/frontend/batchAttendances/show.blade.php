@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.batchAttendance.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-attendances.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $batchAttendance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.batch') }}
                                    </th>
                                    <td>
                                        {{ $batchAttendance->batch->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.student') }}
                                    </th>
                                    <td>
                                        @foreach($batchAttendance->students as $key => $student)
                                            <span class="label label-info">{{ $student->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $batchAttendance->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchAttendance.fields.comment') }}
                                    </th>
                                    <td>
                                        {{ $batchAttendance->comment }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-attendances.index') }}">
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