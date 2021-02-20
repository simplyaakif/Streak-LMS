<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQuestionOptionsTable extends Migration
{
    public function up()
    {
        Schema::table('question_options', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id', 'question_fk_3206078')->references('id')->on('questions');
        });
    }
}
