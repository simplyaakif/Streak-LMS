<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseVideosTable extends Migration
{
    public function up()
    {
        Schema::table('course_videos', function (Blueprint $table) {
            $table->unsignedBigInteger('course_material_id')->nullable();
            $table->foreign('course_material_id', 'course_material_fk_3205998')->references('id')->on('course_materials');
        });
    }
}
