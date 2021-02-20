<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDailyLessonPlannersTable extends Migration
{
    public function up()
    {
        Schema::table('daily_lesson_planners', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3211547')->references('id')->on('users');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_3211551')->references('id')->on('batches');
        });
    }
}
