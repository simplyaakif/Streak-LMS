<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBatchAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('batch_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'batch_fk_3205270')->references('id')->on('batches');
        });
    }
}
