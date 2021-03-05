<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBatchAttendanceRequest;
use App\Http\Requests\StoreBatchAttendanceRequest;
use App\Http\Requests\UpdateBatchAttendanceRequest;
use App\Models\Batch;
use App\Models\BatchAttendance;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BatchAttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('batch_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BatchAttendance::with(['batch', 'students'])->select(sprintf('%s.*', (new BatchAttendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'batch_attendance_show';
                $editGate      = 'batch_attendance_edit';
                $deleteGate    = 'batch_attendance_delete';
                $crudRoutePart = 'batch-attendances';

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

            $table->editColumn('student', function ($row) {
                $labels = [];

                foreach ($row->students as $student) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $student->name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BatchAttendance::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'batch', 'student']);

            return $table->make(true);
        }

        return view('admin.batchAttendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('batch_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id');

        return view('admin.batchAttendances.create', compact('batches', 'students'));
    }

    public function store(StoreBatchAttendanceRequest $request)
    {
        $batchAttendance = BatchAttendance::create($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return redirect()->route('admin.batch-attendances.index');
    }

    public function edit(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id');

        $batchAttendance->load('batch', 'students');

        return view('admin.batchAttendances.edit', compact('batches', 'students', 'batchAttendance'));
    }

    public function update(UpdateBatchAttendanceRequest $request, BatchAttendance $batchAttendance)
    {
        $batchAttendance->update($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return redirect()->route('admin.batch-attendances.index');
    }

    public function show(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchAttendance->load('batch', 'students');

        return view('admin.batchAttendances.show', compact('batchAttendance'));
    }

    public function destroy(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyBatchAttendanceRequest $request)
    {
        BatchAttendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
