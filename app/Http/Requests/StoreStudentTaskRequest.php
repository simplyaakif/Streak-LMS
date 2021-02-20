<?php

namespace App\Http\Requests;

use App\Models\StudentTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_task_create');
    }

    public function rules()
    {
        return [
            'task'       => [
                'string',
                'nullable',
            ],
            'students.*' => [
                'integer',
            ],
            'students'   => [
                'array',
            ],
        ];
    }
}
