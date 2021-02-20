<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaffNotificationRequest;
use App\Http\Requests\StoreStaffNotificationRequest;
use App\Http\Requests\UpdateStaffNotificationRequest;
use App\Models\Employee;
use App\Models\StaffNotification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffNotificationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffNotifications = StaffNotification::with(['staff_members'])->get();

        return view('admin.staffNotifications.index', compact('staffNotifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff_members = Employee::all()->pluck('name', 'id');

        return view('admin.staffNotifications.create', compact('staff_members'));
    }

    public function store(StoreStaffNotificationRequest $request)
    {
        $staffNotification = StaffNotification::create($request->all());
        $staffNotification->staff_members()->sync($request->input('staff_members', []));

        return redirect()->route('admin.staff-notifications.index');
    }

    public function edit(StaffNotification $staffNotification)
    {
        abort_if(Gate::denies('staff_notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff_members = Employee::all()->pluck('name', 'id');

        $staffNotification->load('staff_members');

        return view('admin.staffNotifications.edit', compact('staff_members', 'staffNotification'));
    }

    public function update(UpdateStaffNotificationRequest $request, StaffNotification $staffNotification)
    {
        $staffNotification->update($request->all());
        $staffNotification->staff_members()->sync($request->input('staff_members', []));

        return redirect()->route('admin.staff-notifications.index');
    }

    public function show(StaffNotification $staffNotification)
    {
        abort_if(Gate::denies('staff_notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffNotification->load('staff_members');

        return view('admin.staffNotifications.show', compact('staffNotification'));
    }

    public function destroy(StaffNotification $staffNotification)
    {
        abort_if(Gate::denies('staff_notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffNotification->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffNotificationRequest $request)
    {
        StaffNotification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
