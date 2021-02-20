<?php

namespace App\Http\Requests;

use App\Models\BatchAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBatchAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_attendance_edit');
    }

    public function rules()
    {
        return [
            'batch_id'   => [
                'required',
                'integer',
            ],
            'students.*' => [
                'integer',
            ],
            'students'   => [
                'required',
                'array',
            ],
            'date'       => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
