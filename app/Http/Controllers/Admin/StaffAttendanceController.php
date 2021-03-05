<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaffAttendanceRequest;
use App\Http\Requests\StoreStaffAttendanceRequest;
use App\Http\Requests\UpdateStaffAttendanceRequest;
use App\Models\Employee;
use App\Models\StaffAttendance;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StaffAttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('staff_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StaffAttendance::with(['employee', 'taken_by'])->select(sprintf('%s.*', (new StaffAttendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'staff_attendance_show';
                $editGate      = 'staff_attendance_edit';
                $deleteGate    = 'staff_attendance_delete';
                $crudRoutePart = 'staff-attendances';

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
            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? StaffAttendance::STATUS_RADIO[$row->status] : '';
            });

            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : "";
            });
            $table->addColumn('taken_by_name', function ($row) {
                return $row->taken_by ? $row->taken_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee', 'taken_by']);

            return $table->make(true);
        }

        return view('admin.staffAttendances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('staff_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taken_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.staffAttendances.create', compact('employees', 'taken_bies'));
    }

    public function store(StoreStaffAttendanceRequest $request)
    {
        $staffAttendance = StaffAttendance::create($request->all());

        return redirect()->route('admin.staff-attendances.index');
    }

    public function edit(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taken_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staffAttendance->load('employee', 'taken_by');

        return view('admin.staffAttendances.edit', compact('employees', 'taken_bies', 'staffAttendance'));
    }

    public function update(UpdateStaffAttendanceRequest $request, StaffAttendance $staffAttendance)
    {
        $staffAttendance->update($request->all());

        return redirect()->route('admin.staff-attendances.index');
    }

    public function show(StaffAttendance $staffAttendance)
    {
        abort_if(Gate::denies('staff_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffAttendance->load('employee', 'taken_by');

        return view('admin.staffAttendances.show', compact('staffAttendance'));
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
