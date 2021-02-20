<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'mobile'        => [
                'string',
                'required',
            ],
            'city'          => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'job_title'     => [
                'string',
                'nullable',
            ],
            'cnic_passport' => [
                'string',
                'nullable',
            ],
            'qualification' => [
                'string',
                'nullable',
            ],
            'experience'    => [
                'string',
                'nullable',
            ],
            'relegion'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
