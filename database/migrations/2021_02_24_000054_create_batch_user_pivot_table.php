<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('batch_user', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'batch_id_fk_3195161')->references('id')->on('batches')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_3195161')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
