<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\Admin\StudentResource;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentResource(Student::with(['user'])->get());
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        if ($request->input('dp', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
        }

        if ($request->input('admission_form', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('admission_form')))->toMediaCollection('admission_form');
        }

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentResource($student->load(['user']));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        if ($request->input('dp', false)) {
            if (!$student->dp || $request->input('dp') !== $student->dp->file_name) {
                if ($student->dp) {
                    $student->dp->delete();
                }

                $student->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
            }
        } elseif ($student->dp) {
            $student->dp->delete();
        }

        if ($request->input('admission_form', false)) {
            if (!$student->admission_form || $request->input('admission_form') !== $student->admission_form->file_name) {
                if ($student->admission_form) {
                    $student->admission_form->delete();
                }

                $student->addMedia(storage_path('tmp/uploads/' . $request->input('admission_form')))->toMediaCollection('admission_form');
            }
        } elseif ($student->admission_form) {
            $student->admission_form->delete();
        }

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
