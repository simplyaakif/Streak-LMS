<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeStaffNotificationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('employee_staff_notification', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_notification_id');
            $table->foreign('staff_notification_id', 'staff_notification_id_fk_3206327')->references('id')->on('staff_notifications')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_3206327')->references('id')->on('employees')->onDelete('cascade');
        });
    }
}
