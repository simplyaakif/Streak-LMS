<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('first_language')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('cnic_passport')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('landline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
