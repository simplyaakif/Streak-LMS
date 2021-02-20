<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueriesTable extends Migration
{
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->longText('comments_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
