<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseQueryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_query', function (Blueprint $table) {
            $table->unsignedBigInteger('query_id');
            $table->foreign('query_id', 'query_id_fk_3194723')->references('id')->on('queries')->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_3194723')->references('id')->on('courses')->onDelete('cascade');
        });
    }
}
