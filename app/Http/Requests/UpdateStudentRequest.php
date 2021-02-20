<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'name'           => [
                'string',
                'required',
            ],
            'user_id'        => [
                'required',
                'integer',
            ],
            'father_name'    => [
                'string',
                'nullable',
            ],
            'nationality'    => [
                'string',
                'nullable',
            ],
            'place_of_birth' => [
                'string',
                'nullable',
            ],
            'first_language' => [
                'string',
                'nullable',
            ],
            'date_of_birth'  => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'cnic_passport'  => [
                'string',
                'nullable',
            ],
            'mobile'         => [
                'string',
                'required',
            ],
            'landline'       => [
                'string',
                'nullable',
            ],
        ];
    }
}
