<?php

namespace App\Http\Requests;

use App\Models\QuestionOption;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQuestionOptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_option_create');
    }

    public function rules()
    {
        return [
            'question_id' => [
                'required',
                'integer',
            ],
            'option_text' => [
                'string',
                'required',
            ],
        ];
    }
}
