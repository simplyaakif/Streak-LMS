<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRecoveriesTable extends Migration
{
    public function up()
    {
        Schema::table('recoveries', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_3206181')->references('id')->on('students');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_3206182')->references('id')->on('batches');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_3206197')->references('id')->on('payment_types');
        });
    }
}
