<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeStaffAttendancePivotTable extends Migration
{
    public function up()
    {
        Schema::create('employee_staff_attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_attendance_id');
            $table->foreign('staff_attendance_id', 'staff_attendance_id_fk_3205711')->references('id')->on('staff_attendances')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_3205711')->references('id')->on('employees')->onDelete('cascade');
        });
    }
}
