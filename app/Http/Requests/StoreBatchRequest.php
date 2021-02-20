<?php

namespace App\Http\Requests;

use App\Models\Batch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_create');
    }

    public function rules()
    {
        return [
            'title'         => [
                'string',
                'required',
            ],
            'course_id'     => [
                'required',
                'integer',
            ],
            'class_time'    => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'strength'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'instructors.*' => [
                'integer',
            ],
            'instructors'   => [
                'required',
                'array',
            ],
        ];
    }
}
