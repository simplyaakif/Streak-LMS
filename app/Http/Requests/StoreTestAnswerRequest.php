<?php

namespace App\Http\Requests;

use App\Models\TestAnswer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_answer_create');
    }

    public function rules()
    {
        return [];
    }
}
