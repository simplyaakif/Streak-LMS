<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaffAttendanceRequest;
use App\Http\Requests\StoreStaffAttendanceRequest;
use App\Http\Requests\UpdateStaffAttendanceRequest;
use App\Models\Batch;
use App\Models\Employee;
use App\Models\StaffAttendance;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffAttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffAttendances = StaffAttendance::with(['batch', 'students', 'taken_by'])->get();

        return view('frontend.staffAttendances.index', compact('staffAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Employee::all()->pluck('name', 'id');

        $taken_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.staffAttendances.create', compact('batches', 'students', 'taken_bies'));
    }

    public function store(StoreStaffAttendanceRequest $request)
    {
        $staffAttendance = StaffAttendance::create($request->all());
        $staffAttendance->students()->sync($request->input('students', []));

        return redirect()->route('frontend.staff-attendances.index');
    }

    public function edit(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Employee::all()->pluck('name', 'id');

        $taken_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staffAttendance->load('batch', 'students', 'taken_by');

        return view('frontend.staffAttendances.edit', compact('batches', 'students', 'taken_bies', 'staffAttendance'));
    }

    public function update(UpdateStaffAttendanceRequest $request, StaffAttendance $staffAttendance)
    {
        $staffAttendance->update($request->all());
        $staffAttendance->students()->sync($request->input('students', []));

        return redirect()->route('frontend.staff-attendances.index');
    }

    public function show(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffAttendance->load('batch', 'students', 'taken_by');

        return view('frontend.staffAttendances.show', compact('staffAttendance'));
    }

    public function destroy(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffAttendanceRequest $request)
    {
        StaffAttendance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
