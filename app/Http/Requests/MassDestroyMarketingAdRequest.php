<?php

namespace App\Http\Requests;

use App\Models\MarketingAd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMarketingAdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('marketing_ad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:marketing_ads,id',
        ];
    }
}
