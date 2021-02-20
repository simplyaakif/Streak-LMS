<?php

namespace App\Http\Controllers\Frontend;

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

class BatchAttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('batch_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchAttendances = BatchAttendance::with(['batch', 'students'])->get();

        return view('frontend.batchAttendances.index', compact('batchAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id');

        return view('frontend.batchAttendances.create', compact('batches', 'students'));
    }

    public function store(StoreBatchAttendanceRequest $request)
    {
        $batchAttendance = BatchAttendance::create($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return redirect()->route('frontend.batch-attendances.index');
    }

    public function edit(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::all()->pluck('name', 'id');

        $batchAttendance->load('batch', 'students');

        return view('frontend.batchAttendances.edit', compact('batches', 'students', 'batchAttendance'));
    }

    public function update(UpdateBatchAttendanceRequest $request, BatchAttendance $batchAttendance)
    {
        $batchAttendance->update($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return redirect()->route('frontend.batch-attendances.index');
    }

    public function show(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchAttendance->load('batch', 'students');

        return view('frontend.batchAttendances.show', compact('batchAttendance'));
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
