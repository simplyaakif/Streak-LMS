<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStaffAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('staff_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('taken_by_id')->nullable();
            $table->foreign('taken_by_id', 'taken_by_fk_3205714')->references('id')->on('users');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_3253213')->references('id')->on('employees');
        });
    }
}
