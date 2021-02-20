@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.id') }}
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.name') }}
                        </th>
                        <td>
                            {{ $employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.dp') }}
                        </th>
                        <td>
                            @if($employee->dp)
                                <a href="{{ $employee->dp->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $employee->dp->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.user') }}
                        </th>
                        <td>
                            {{ $employee->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.mobile') }}
                        </th>
                        <td>
                            {{ $employee->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.email') }}
                        </th>
                        <td>
                            {{ $employee->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.address') }}
                        </th>
                        <td>
                            {{ $employee->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.city') }}
                        </th>
                        <td>
                            {{ $employee->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $employee->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Employee::GENDER_SELECT[$employee->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.marital_status') }}
                        </th>
                        <td>
                            {{ App\Models\Employee::MARITAL_STATUS_SELECT[$employee->marital_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.job_title') }}
                        </th>
                        <td>
                            {{ $employee->job_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.cnic_passport') }}
                        </th>
                        <td>
                            {{ $employee->cnic_passport }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.qualification') }}
                        </th>
                        <td>
                            {{ $employee->qualification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.experience') }}
                        </th>
                        <td>
                            {{ $employee->experience }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.relegion') }}
                        </th>
                        <td>
                            {{ $employee->relegion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.documents_cv_experience') }}
                        </th>
                        <td>
                            @foreach($employee->documents_cv_experience as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.earning_type') }}
                        </th>
                        <td>
                            {{ App\Models\Employee::EARNING_TYPE_SELECT[$employee->earning_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.basic_salary') }}
                        </th>
                        <td>
                            {{ $employee->basic_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.medical') }}
                        </th>
                        <td>
                            {{ $employee->medical }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.conveyance') }}
                        </th>
                        <td>
                            {{ $employee->conveyance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.deduction_leave') }}
                        </th>
                        <td>
                            {{ $employee->deduction_leave }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.deduction_loan') }}
                        </th>
                        <td>
                            {{ $employee->deduction_loan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.deduction_tax') }}
                        </th>
                        <td>
                            {{ $employee->deduction_tax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.deduction_other') }}
                        </th>
                        <td>
                            {{ $employee->deduction_other }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection