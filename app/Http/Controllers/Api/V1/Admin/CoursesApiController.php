<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Admin\CourseResource;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['course_duration'])->get());
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());

        if ($request->input('course_content', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('course_content')))->toMediaCollection('course_content');
        }

        if ($request->input('thumbnail', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['course_duration']));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());

        if ($request->input('course_content', false)) {
            if (!$course->course_content || $request->input('course_content') !== $course->course_content->file_name) {
                if ($course->course_content) {
                    $course->course_content->delete();
                }

                $course->addMedia(storage_path('tmp/uploads/' . $request->input('course_content')))->toMediaCollection('course_content');
            }
        } elseif ($course->course_content) {
            $course->course_content->delete();
        }

        if ($request->input('thumbnail', false)) {
            if (!$course->thumbnail || $request->input('thumbnail') !== $course->thumbnail->file_name) {
                if ($course->thumbnail) {
                    $course->thumbnail->delete();
                }

                $course->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
            }
        } elseif ($course->thumbnail) {
            $course->thumbnail->delete();
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
