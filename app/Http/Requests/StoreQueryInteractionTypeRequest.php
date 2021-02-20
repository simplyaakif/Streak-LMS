<?php

namespace App\Http\Requests;

use App\Models\QueryInteractionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQueryInteractionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('query_interaction_type_create');
    }

    public function rules()
    {
        return [
            'title'   => [
                'string',
                'required',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
        ];
    }
}
