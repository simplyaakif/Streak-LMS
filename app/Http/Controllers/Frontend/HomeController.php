<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $student = Student::where('user_id',Auth::user()->id)->get();
        $data=[
            'student'=>$student
        ];
        return view('student.home',$data);
    }
}
