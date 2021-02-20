<?php

namespace App\Http\Requests;

use App\Models\DailyLessonPlanner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDailyLessonPlannerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daily_lesson_planner_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
