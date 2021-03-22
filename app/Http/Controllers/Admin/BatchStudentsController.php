<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BatchStudentsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('batch_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $batches = Batch::all();
        return view('admin.batchStudents.index',compact('batches'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student_statuses = StudentStatus::all()->pluck('status_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.batchStudents.create', compact('batches', 'students', 'student_statuses'));
    }

    public function store(StoreBatchStudentRequest $request)
    {
        $batchStudent = BatchStudent::create($request->all());

        return redirect()->route('admin.batch-students.index');
    }

    public function edit(BatchStudent $batchStudent)
    {
        abort_if(Gate::denies('batch_student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student_statuses = StudentStatus::all()->pluck('status_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batchStudent->load('batch', 'student', 'student_status');

        return view('admin.batchStudents.edit', compact('batches', 'students', 'student_statuses', 'batchStudent'));
    }

    public function update(UpdateBatchStudentRequest $request, BatchStudent $batchStudent)
    {
        $batchStudent->update($request->all());

        return redirect()->route('admin.batch-students.index');
    }

    public function show(Batch $batch)
    {
        abort_if(Gate::denies('batch_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $batchStudent->load('batch', 'student', 'student_status');

        return view('admin.batchStudents.show', compact('batch'));
    }

    public function batch(Batch $batch)
    {
        $batch_students = BatchStudent::with('student')->where('batch_id',$batch->id)->where('student_status_id','1')
            ->get();
//        dd($batch_students);
        return view('admin.batchStudents.show', compact('batch','batch_students'));
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
