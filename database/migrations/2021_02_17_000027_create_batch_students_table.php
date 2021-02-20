<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('batch_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sessions_start_date');
            $table->date('session_end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
