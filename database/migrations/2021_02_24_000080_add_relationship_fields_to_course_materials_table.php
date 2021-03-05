<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseMaterialsTable extends Migration
{
    public function up()
    {
        Schema::table('course_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_3205980')->references('id')->on('courses');
        });
    }
}
