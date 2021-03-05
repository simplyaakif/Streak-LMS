<?php

namespace App\Http\Requests;

use App\Models\StudentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_status_edit');
    }

    public function rules()
    {
        return [
            'status_title' => [
                'string',
                'required',
            ],
            'start_date'   => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
