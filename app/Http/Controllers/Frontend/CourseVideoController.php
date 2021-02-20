<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseVideoRequest;
use App\Http\Requests\StoreCourseVideoRequest;
use App\Http\Requests\UpdateCourseVideoRequest;
use App\Models\CourseMaterial;
use App\Models\CourseVideo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseVideoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseVideos = CourseVideo::with(['course_material', 'media'])->get();

        return view('frontend.courseVideos.index', compact('courseVideos'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course_materials = CourseMaterial::all()->pluck('chapter_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.courseVideos.create', compact('course_materials'));
    }

    public function store(StoreCourseVideoRequest $request)
    {
        $courseVideo = CourseVideo::create($request->all());

        if ($request->input('video', false)) {
            $courseVideo->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseVideo->id]);
        }

        return redirect()->route('frontend.course-videos.index');
    }

    public function edit(CourseVideo $courseVideo)
    {
        abort_if(Gate::denies('course_video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course_materials = CourseMaterial::all()->pluck('chapter_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseVideo->load('course_material');

        return view('frontend.courseVideos.edit', compact('course_materials', 'courseVideo'));
    }

    public function update(UpdateCourseVideoRequest $request, CourseVideo $courseVideo)
    {
        $courseVideo->update($request->all());

        if ($request->input('video', false)) {
            if (!$courseVideo->video || $request->input('video') !== $courseVideo->video->file_name) {
                if ($courseVideo->video) {
                    $courseVideo->video->delete();
                }

                $courseVideo->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
            }
        } elseif ($courseVideo->video) {
            $courseVideo->video->delete();
        }

        return redirect()->route('frontend.course-videos.index');
    }

    public function show(CourseVideo $courseVideo)
    {
        abort_if(Gate::denies('course_video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseVideo->load('course_material');

        return view('frontend.courseVideos.show', compact('courseVideo'));
    }

    public function destroy(CourseVideo $courseVideo)
    {
        abort_if(Gate::denies('course_video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseVideo->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseVideoRequest $request)
    {
        CourseVideo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_video_create') && Gate::denies('course_video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseVideo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
