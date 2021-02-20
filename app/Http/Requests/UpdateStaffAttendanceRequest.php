<?php

namespace App\Http\Requests;

use App\Models\StaffAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaffAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_attendance_edit');
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
