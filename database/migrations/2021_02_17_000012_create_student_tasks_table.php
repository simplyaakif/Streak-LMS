<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTasksTable extends Migration
{
    public function up()
    {
        Schema::create('student_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task')->nullable();
            $table->longText('details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
