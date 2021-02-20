<?php

namespace App\Http\Requests;

use App\Models\BatchNotification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBatchNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_notification_edit');
    }

    public function rules()
    {
        return [
            'batches.*'  => [
                'integer',
            ],
            'batches'    => [
                'array',
            ],
            'title'      => [
                'string',
                'nullable',
            ],
            'publish_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'valid_till' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
