<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('job_title')->nullable();
            $table->string('cnic_passport')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('relegion')->nullable();
            $table->string('earning_type')->nullable();
            $table->decimal('basic_salary', 15, 2)->nullable();
            $table->decimal('medical', 15, 2)->nullable();
            $table->decimal('conveyance', 15, 2)->nullable();
            $table->decimal('deduction_leave', 15, 2)->nullable();
            $table->decimal('deduction_loan', 15, 2)->nullable();
            $table->decimal('deduction_tax', 15, 2)->nullable();
            $table->decimal('deduction_other', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
