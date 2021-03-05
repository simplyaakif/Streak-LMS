<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->longText('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
