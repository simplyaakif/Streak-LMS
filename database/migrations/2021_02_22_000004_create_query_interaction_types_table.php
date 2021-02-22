<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueryInteractionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('query_interaction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
