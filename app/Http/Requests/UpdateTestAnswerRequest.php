<?php

namespace App\Http\Requests;

use App\Models\TestAnswer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTestAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_answer_edit');
    }

    public function rules()
    {
        return [];
    }
}
