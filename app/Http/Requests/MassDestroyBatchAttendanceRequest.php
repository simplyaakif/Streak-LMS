<?php

namespace App\Http\Requests;

use App\Models\BatchAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBatchAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('batch_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:batch_attendances,id',
        ];
    }
}
