<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CourseDuration;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CoursesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::with(['course_duration', 'media'])->get();

        return view('frontend.courses.index', compact('courses'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course_durations = CourseDuration::all()->pluck('duration', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.courses.create', compact('course_durations'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());

        foreach ($request->input('course_content', []) as $file) {
            $course->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('course_content');
        }

        if ($request->input('thumbnail', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }

        return redirect()->route('frontend.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course_durations = CourseDuration::all()->pluck('duration', 'id')->prepend(trans('global.pleaseSelect'), '');

        $course->load('course_duration');

        return view('frontend.courses.edit', compact('course_durations', 'course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());

        if (count($course->course_content) > 0) {
            foreach ($course->course_content as $media) {
                if (!in_array($media->file_name, $request->input('course_content', []))) {
                    $media->delete();
                }
            }
        }

        $media = $course->course_content->pluck('file_name')->toArray();

        foreach ($request->input('course_content', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $course->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('course_content');
            }
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

        return redirect()->route('frontend.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('course_duration');

        return view('frontend.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
