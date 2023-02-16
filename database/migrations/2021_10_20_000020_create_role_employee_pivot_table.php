<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleEmployeePivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_5087137')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_5087137')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
