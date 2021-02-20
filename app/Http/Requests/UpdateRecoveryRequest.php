<?php

namespace App\Http\Requests;

use App\Models\Recovery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRecoveryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recovery_edit');
    }

    public function rules()
    {
        return [
            'paid_on'          => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reference_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
