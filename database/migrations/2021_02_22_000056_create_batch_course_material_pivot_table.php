<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchCourseMaterialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('batch_course_material', function (Blueprint $table) {
            $table->unsignedBigInteger('course_material_id');
            $table->foreign('course_material_id', 'course_material_id_fk_3205981')->references('id')->on('course_materials')->onDelete('cascade');
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'batch_id_fk_3205981')->references('id')->on('batches')->onDelete('cascade');
        });
    }
}
