<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDailyLessonPlannerRequest;
use App\Http\Requests\StoreDailyLessonPlannerRequest;
use App\Http\Requests\UpdateDailyLessonPlannerRequest;
use App\Models\Batch;
use App\Models\DailyLessonPlanner;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DailyLessonPlannerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('daily_lesson_planner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyLessonPlanners = DailyLessonPlanner::with(['user', 'batch', 'media'])->get();

        return view('frontend.dailyLessonPlanners.index', compact('dailyLessonPlanners'));
    }

    public function create()
    {
        abort_if(Gate::denies('daily_lesson_planner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.dailyLessonPlanners.create', compact('users', 'batches'));
    }

    public function store(StoreDailyLessonPlannerRequest $request)
    {
        $dailyLessonPlanner = DailyLessonPlanner::create($request->all());

        if ($request->input('files', false)) {
            $dailyLessonPlanner->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dailyLessonPlanner->id]);
        }

        return redirect()->route('frontend.daily-lesson-planners.index');
    }

    public function edit(DailyLessonPlanner $dailyLessonPlanner)
    {
        abort_if(Gate::denies('daily_lesson_planner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dailyLessonPlanner->load('user', 'batch');

        return view('frontend.dailyLessonPlanners.edit', compact('users', 'batches', 'dailyLessonPlanner'));
    }

    public function update(UpdateDailyLessonPlannerRequest $request, DailyLessonPlanner $dailyLessonPlanner)
    {
        $dailyLessonPlanner->update($request->all());

        if ($request->input('files', false)) {
            if (!$dailyLessonPlanner->files || $request->input('files') !== $dailyLessonPlanner->files->file_name) {
                if ($dailyLessonPlanner->files) {
                    $dailyLessonPlanner->files->delete();
                }

                $dailyLessonPlanner->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($dailyLessonPlanner->files) {
            $dailyLessonPlanner->files->delete();
        }

        return redirect()->route('frontend.daily-lesson-planners.index');
    }

    public function show(DailyLessonPlanner $dailyLessonPlanner)
    {
        abort_if(Gate::denies('daily_lesson_planner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyLessonPlanner->load('user', 'batch');

        return view('frontend.dailyLessonPlanners.show', compact('dailyLessonPlanner'));
    }

    public function destroy(DailyLessonPlanner $dailyLessonPlanner)
    {
        abort_if(Gate::denies('daily_lesson_planner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyLessonPlanner->delete();

        return back();
    }

    public function massDestroy(MassDestroyDailyLessonPlannerRequest $request)
    {
        DailyLessonPlanner::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('daily_lesson_planner_create') && Gate::denies('daily_lesson_planner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DailyLessonPlanner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
