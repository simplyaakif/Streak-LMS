<?php

namespace App\Http\Requests;

use App\Models\DailyLessonPlanner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDailyLessonPlannerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('daily_lesson_planner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:daily_lesson_planners,id',
        ];
    }
}
