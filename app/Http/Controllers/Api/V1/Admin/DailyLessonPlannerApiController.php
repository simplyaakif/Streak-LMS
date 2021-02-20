<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDailyLessonPlannerRequest;
use App\Http\Requests\UpdateDailyLessonPlannerRequest;
use App\Http\Resources\Admin\DailyLessonPlannerResource;
use App\Models\DailyLessonPlanner;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DailyLessonPlannerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('daily_lesson_planner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyLessonPlannerResource(DailyLessonPlanner::with(['user', 'batch'])->get());
    }

    public function store(StoreDailyLessonPlannerRequest $request)
    {
        $dailyLessonPlanner = DailyLessonPlanner::create($request->all());

        if ($request->input('files', false)) {
            $dailyLessonPlanner->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new DailyLessonPlannerResource($dailyLessonPlanner))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DailyLessonPlanner $dailyLessonPlanner)
    {
        abort_if(Gate::denies('daily_lesson_planner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyLessonPlannerResource($dailyLessonPlanner->load(['user', 'batch']));
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

        return (new DailyLessonPlannerResource($dailyLessonPlanner))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DailyLessonPlanner $dailyLessonPlanner)
    {
        abort_if(Gate::denies('daily_lesson_planner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyLessonPlanner->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
