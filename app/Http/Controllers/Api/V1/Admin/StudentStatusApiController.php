<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentStatusRequest;
use App\Http\Requests\UpdateStudentStatusRequest;
use App\Http\Resources\Admin\StudentStatusResource;
use App\Models\StudentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentStatusResource(StudentStatus::all());
    }

    public function store(StoreStudentStatusRequest $request)
    {
        $studentStatus = StudentStatus::create($request->all());

        return (new StudentStatusResource($studentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentStatus $studentStatus)
    {
        abort_if(Gate::denies('student_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentStatusResource($studentStatus);
    }

    public function update(UpdateStudentStatusRequest $request, StudentStatus $studentStatus)
    {
        $studentStatus->update($request->all());

        return (new StudentStatusResource($studentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentStatus $studentStatus)
    {
        abort_if(Gate::denies('student_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
