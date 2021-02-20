<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('course_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chapter_number')->nullable();
            $table->string('chapter_name')->nullable();
            $table->longText('chapter_details')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
