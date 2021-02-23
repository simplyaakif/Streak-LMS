<?php

namespace App\Http\Requests;

use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstitutionCalendarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institution_calendar_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'date'  => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
