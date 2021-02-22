<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCertificatesTable extends Migration
{
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_3218637')->references('id')->on('students');
            $table->unsignedBigInteger('course_batch_session_id')->nullable();
            $table->foreign('course_batch_session_id', 'course_batch_session_fk_3218638')->references('id')->on('batches');
        });
    }
}
