<?php

namespace App\Http\Requests;

use App\Models\StaffNotification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStaffNotificationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('staff_notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:staff_notifications,id',
        ];
    }
}
