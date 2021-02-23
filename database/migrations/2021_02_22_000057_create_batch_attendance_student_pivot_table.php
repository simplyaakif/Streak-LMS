<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchAttendanceStudentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('batch_attendance_student', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_attendance_id');
            $table->foreign('batch_attendance_id', 'batch_attendance_id_fk_3205271')->references('id')->on('batch_attendances')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_3205271')->references('id')->on('students')->onDelete('cascade');
        });
    }
}
