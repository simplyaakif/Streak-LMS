<?php

namespace App\Http\Requests;

use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstitutionCalendarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institution_calendar_edit');
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
