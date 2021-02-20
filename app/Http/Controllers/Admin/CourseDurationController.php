<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseDurationRequest;
use App\Http\Requests\StoreCourseDurationRequest;
use App\Http\Requests\UpdateCourseDurationRequest;
use App\Models\CourseDuration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseDurationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_duration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseDurations = CourseDuration::all();

        return view('admin.courseDurations.index', compact('courseDurations'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_duration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseDurations.create');
    }

    public function store(StoreCourseDurationRequest $request)
    {
        $courseDuration = CourseDuration::create($request->all());

        return redirect()->route('admin.course-durations.index');
    }

    public function edit(CourseDuration $courseDuration)
    {
        abort_if(Gate::denies('course_duration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseDurations.edit', compact('courseDuration'));
    }

    public function update(UpdateCourseDurationRequest $request, CourseDuration $courseDuration)
    {
        $courseDuration->update($request->all());

        return redirect()->route('admin.course-durations.index');
    }

    public function show(CourseDuration $courseDuration)
    {
        abort_if(Gate::denies('course_duration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.courseDurations.show', compact('courseDuration'));
    }

    public function destroy(CourseDuration $courseDuration)
    {
        abort_if(Gate::denies('course_duration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseDuration->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseDurationRequest $request)
    {
        CourseDuration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
