<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchBatchNotificationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('batch_batch_notification', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_notification_id');
            $table->foreign('batch_notification_id', 'batch_notification_id_fk_3206201')->references('id')->on('batch_notifications')->onDelete('cascade');
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'batch_id_fk_3206201')->references('id')->on('batches')->onDelete('cascade');
        });
    }
}
