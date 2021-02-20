<?php

namespace App\Http\Requests;

use App\Models\CourseVideo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseVideoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_video_create');
    }

    public function rules()
    {
        return [];
    }
}
