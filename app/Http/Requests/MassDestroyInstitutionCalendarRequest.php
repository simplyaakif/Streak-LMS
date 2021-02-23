<?php

namespace App\Http\Requests;

use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInstitutionCalendarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('institution_calendar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:institution_calendars,id',
        ];
    }
}
