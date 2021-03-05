<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentTasksTable extends Migration
{
    public function up()
    {
        Schema::table('student_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_by_id')->nullable();
            $table->foreign('assigned_by_id', 'assigned_by_fk_3274096')->references('id')->on('employees');
        });
    }
}
