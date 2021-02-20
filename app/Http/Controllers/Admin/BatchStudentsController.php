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

        if ($request->ajax()) {
            $query = BatchStudent::with(['batch', 'student', 'student_status'])->select(sprintf('%s.*', (new BatchStudent)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'batch_student_show';
                $editGate      = 'batch_student_edit';
                $deleteGate    = 'batch_student_delete';
                $crudRoutePart = 'batch-students';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('batch_title', function ($row) {
                return $row->batch ? $row->batch->title : '';
            });

            $table->addColumn('student_name', function ($row) {
                return $row->student ? $row->student->name : '';
            });

            $table->addColumn('student_status_status_title', function ($row) {
                return $row->student_status ? $row->student_status->status_title : '';
            });

            $table->editColumn('student_status.comments', function ($row) {
                return $row->student_status ? (is_string($row->student_status) ? $row->student_status : $row->student_status->comments) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'batch', 'student', 'student_status']);

            return $table->make(true);
        }

        return view('admin.batchStudents.index');
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

    public function show(BatchStudent $batchStudent)
    {
        abort_if(Gate::denies('batch_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchStudent->load('batch', 'student', 'student_status');

        return view('admin.batchStudents.show', compact('batchStudent'));
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
