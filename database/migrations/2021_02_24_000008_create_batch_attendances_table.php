<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('batch_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->longText('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
