<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchStudentStudentTaskPivotTable extends Migration
{
    public function up()
    {
        Schema::create('batch_student_student_task', function (Blueprint $table) {
            $table->unsignedBigInteger('student_task_id');
            $table->foreign('student_task_id', 'student_task_id_fk_3205805')->references('id')->on('student_tasks')->onDelete('cascade');
            $table->unsignedBigInteger('batch_student_id');
            $table->foreign('batch_student_id', 'batch_student_id_fk_3205805')->references('id')->on('batch_students')->onDelete('cascade');
        });
    }
}
