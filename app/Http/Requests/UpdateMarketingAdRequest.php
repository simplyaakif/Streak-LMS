<?php

namespace App\Http\Requests;

use App\Models\MarketingAd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMarketingAdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marketing_ad_edit');
    }

    public function rules()
    {
        return [
            'title'      => [
                'string',
                'nullable',
            ],
            'publish_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'valid_till' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
