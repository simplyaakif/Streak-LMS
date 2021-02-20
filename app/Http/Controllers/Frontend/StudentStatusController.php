<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentStatusRequest;
use App\Http\Requests\StoreStudentStatusRequest;
use App\Http\Requests\UpdateStudentStatusRequest;
use App\Models\StudentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentStatuses = StudentStatus::all();

        return view('frontend.studentStatuses.index', compact('studentStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.studentStatuses.create');
    }

    public function store(StoreStudentStatusRequest $request)
    {
        $studentStatus = StudentStatus::create($request->all());

        return redirect()->route('frontend.student-statuses.index');
    }

    public function edit(StudentStatus $studentStatus)
    {
        abort_if(Gate::denies('student_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.studentStatuses.edit', compact('studentStatus'));
    }

    public function update(UpdateStudentStatusRequest $request, StudentStatus $studentStatus)
    {
        $studentStatus->update($request->all());

        return redirect()->route('frontend.student-statuses.index');
    }

    public function show(StudentStatus $studentStatus)
    {
        abort_if(Gate::denies('student_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.studentStatuses.show', compact('studentStatus'));
    }

    public function destroy(StudentStatus $studentStatus)
    {
        abort_if(Gate::denies('student_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentStatusRequest $request)
    {
        StudentStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
