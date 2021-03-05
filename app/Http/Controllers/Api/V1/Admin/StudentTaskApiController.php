<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudentTaskRequest;
use App\Http\Requests\UpdateStudentTaskRequest;
use App\Http\Resources\Admin\StudentTaskResource;
use App\Models\StudentTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentTaskApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentTaskResource(StudentTask::with(['assigned_by', 'students'])->get());
    }

    public function store(StoreStudentTaskRequest $request)
    {
        $studentTask = StudentTask::create($request->all());
        $studentTask->students()->sync($request->input('students', []));

        if ($request->input('files', false)) {
            $studentTask->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new StudentTaskResource($studentTask))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentTask $studentTask)
    {
        abort_if(Gate::denies('student_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentTaskResource($studentTask->load(['assigned_by', 'students']));
    }

    public function update(UpdateStudentTaskRequest $request, StudentTask $studentTask)
    {
        $studentTask->update($request->all());
        $studentTask->students()->sync($request->input('students', []));

        if ($request->input('files', false)) {
            if (!$studentTask->files || $request->input('files') !== $studentTask->files->file_name) {
                if ($studentTask->files) {
                    $studentTask->files->delete();
                }

                $studentTask->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($studentTask->files) {
            $studentTask->files->delete();
        }

        return (new StudentTaskResource($studentTask))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentTask $studentTask)
    {
        abort_if(Gate::denies('student_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTask->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
