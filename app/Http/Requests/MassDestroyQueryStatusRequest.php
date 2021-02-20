<?php

namespace App\Http\Requests;

use App\Models\QueryStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQueryStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('query_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:query_statuses,id',
        ];
    }
}
