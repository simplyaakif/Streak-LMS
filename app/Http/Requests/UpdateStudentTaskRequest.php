<?php

namespace App\Http\Requests;

use App\Models\StudentTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_task_edit');
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
