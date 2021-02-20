@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.batchStudent.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-students.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.batch') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->batch->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.student') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->student->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.sessions_start_date') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->sessions_start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.session_end_date') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->session_end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.batchStudent.fields.student_status') }}
                                    </th>
                                    <td>
                                        {{ $batchStudent->student_status->status_title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.batch-students.index') }}">
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