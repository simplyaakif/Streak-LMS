<?php

namespace App\Http\Requests;

use App\Models\TestResult;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestResultRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_result_create');
    }

    public function rules()
    {
        return [
            'score' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
