<?php

namespace App\Http\Requests;

use App\Models\CourseMaterial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseMaterialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_material_create');
    }

    public function rules()
    {
        return [
            'batches.*'      => [
                'integer',
            ],
            'batches'        => [
                'array',
            ],
            'chapter_number' => [
                'string',
                'nullable',
            ],
            'chapter_name'   => [
                'string',
                'nullable',
            ],
            'position'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
