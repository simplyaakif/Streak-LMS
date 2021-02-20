<?php

namespace App\Http\Requests;

use App\Models\StudentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_status_create');
    }

    public function rules()
    {
        return [
            'status_title' => [
                'string',
                'required',
            ],
        ];
    }
}
