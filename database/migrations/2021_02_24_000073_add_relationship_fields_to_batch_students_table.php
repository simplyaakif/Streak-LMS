<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBatchStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('batch_students', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'batch_fk_3202177')->references('id')->on('batches');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_fk_3202178')->references('id')->on('students');
            $table->unsignedBigInteger('student_status_id');
            $table->foreign('student_status_id', 'student_status_fk_3202558')->references('id')->on('student_statuses');
        });
    }
}
