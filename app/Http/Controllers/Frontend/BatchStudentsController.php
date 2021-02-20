<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBatchStudentRequest;
use App\Http\Requests\StoreBatchStudentRequest;
use App\Http\Requests\UpdateBatchStudentRequest;
use App\Models\Batch;
use App\Models\BatchStudent;
use App\Models\Student;
use App\Models\StudentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchStudentsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('batch_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchStudents = BatchStudent::with(['batch', 'student', 'student_status'])->get();

        return view('frontend.batchStudents.index', compact('batchStudents'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student_statuses = StudentStatus::all()->pluck('status_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.batchStudents.create', compact('batches', 'students', 'student_statuses'));
    }

    public function store(StoreBatchStudentRequest $request)
    {
        $batchStudent = BatchStudent::create($request->all());

        return redirect()->route('frontend.batch-students.index');
    }

    public function edit(BatchStudent $batchStudent)
    {
        abort_if(Gate::denies('batch_student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student_statuses = StudentStatus::all()->pluck('status_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batchStudent->load('batch', 'student', 'student_status');

        return view('frontend.batchStudents.edit', compact('batches', 'students', 'student_statuses', 'batchStudent'));
    }

    public function update(UpdateBatchStudentRequest $request, BatchStudent $batchStudent)
    {
        $batchStudent->update($request->all());

        return redirect()->route('frontend.batch-students.index');
    }

    public function show(BatchStudent $batchStudent)
    {
        abort_if(Gate::denies('batch_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchStudent->load('batch', 'student', 'student_status');

        return view('frontend.batchStudents.show', compact('batchStudent'));
    }

    public function destroy(BatchStudent $batchStudent)
    {
        abort_if(Gate::denies('batch_student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchStudent->delete();

        return back();
    }

    public function massDestroy(MassDestroyBatchStudentRequest $request)
    {
        BatchStudent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
