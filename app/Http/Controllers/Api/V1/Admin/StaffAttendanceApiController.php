<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffAttendanceRequest;
use App\Http\Requests\UpdateStaffAttendanceRequest;
use App\Http\Resources\Admin\StaffAttendanceResource;
use App\Models\StaffAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffAttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaffAttendanceResource(StaffAttendance::with(['batch', 'students', 'taken_by'])->get());
    }

    public function store(StoreStaffAttendanceRequest $request)
    {
        $staffAttendance = StaffAttendance::create($request->all());
        $staffAttendance->students()->sync($request->input('students', []));

        return (new StaffAttendanceResource($staffAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaffAttendanceResource($staffAttendance->load(['batch', 'students', 'taken_by']));
    }

    public function update(UpdateStaffAttendanceRequest $request, StaffAttendance $staffAttendance)
    {
        $staffAttendance->update($request->all());
        $staffAttendance->students()->sync($request->input('students', []));

        return (new StaffAttendanceResource($staffAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffAttendance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
