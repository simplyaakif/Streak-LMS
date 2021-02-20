<?php

namespace App\Http\Requests;

use App\Models\CourseDuration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseDurationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_duration_edit');
    }

    public function rules()
    {
        return [
            'duration' => [
                'string',
                'required',
            ],
        ];
    }
}
