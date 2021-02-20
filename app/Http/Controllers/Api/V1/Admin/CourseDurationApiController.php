<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseDurationRequest;
use App\Http\Requests\UpdateCourseDurationRequest;
use App\Http\Resources\Admin\CourseDurationResource;
use App\Models\CourseDuration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseDurationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_duration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseDurationResource(CourseDuration::all());
    }

    public function store(StoreCourseDurationRequest $request)
    {
        $courseDuration = CourseDuration::create($request->all());

        return (new CourseDurationResource($courseDuration))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseDuration $courseDuration)
    {
        abort_if(Gate::denies('course_duration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseDurationResource($courseDuration);
    }

    public function update(UpdateCourseDurationRequest $request, CourseDuration $courseDuration)
    {
        $courseDuration->update($request->all());

        return (new CourseDurationResource($courseDuration))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseDuration $courseDuration)
    {
        abort_if(Gate::denies('course_duration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseDuration->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
