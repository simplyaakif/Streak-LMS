<?php

namespace App\Http\Requests;

use App\Models\BatchStudent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBatchStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_student_edit');
    }

    public function rules()
    {
        return [
            'batch_id'            => [
                'required',
                'integer',
            ],
            'student_id'          => [
                'required',
                'integer',
            ],
            'sessions_start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'session_end_date'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'student_status_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
