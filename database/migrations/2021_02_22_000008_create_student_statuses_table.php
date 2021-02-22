<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('student_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_title');
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
