<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\Admin\EmployeeResource;
use App\Models\Employee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeResource(Employee::with(['user'])->get());
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());

        if ($request->input('dp', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
        }

        if ($request->input('documents_cv_experience', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . $request->input('documents_cv_experience')))->toMediaCollection('documents_cv_experience');
        }

        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeResource($employee->load(['user']));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        if ($request->input('dp', false)) {
            if (!$employee->dp || $request->input('dp') !== $employee->dp->file_name) {
                if ($employee->dp) {
                    $employee->dp->delete();
                }

                $employee->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
            }
        } elseif ($employee->dp) {
            $employee->dp->delete();
        }

        if ($request->input('documents_cv_experience', false)) {
            if (!$employee->documents_cv_experience || $request->input('documents_cv_experience') !== $employee->documents_cv_experience->file_name) {
                if ($employee->documents_cv_experience) {
                    $employee->documents_cv_experience->delete();
                }

                $employee->addMedia(storage_path('tmp/uploads/' . $request->input('documents_cv_experience')))->toMediaCollection('documents_cv_experience');
            }
        } elseif ($employee->documents_cv_experience) {
            $employee->documents_cv_experience->delete();
        }

        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
