<?php

namespace App\Http\Requests;

use App\Models\StaffNotification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStaffNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('staff_notification_create');
    }

    public function rules()
    {
        return [
            'title'           => [
                'string',
                'nullable',
            ],
            'publish_at'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'valid_till'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'staff_members.*' => [
                'integer',
            ],
            'staff_members'   => [
                'array',
            ],
        ];
    }
}
