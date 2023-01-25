<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5091125')->references('id')->on('users');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id', 'type_fk_5091186')->references('id')->on('reports');
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->foreign('clinic_id', 'clinic_fk_5091127')->references('id')->on('clinics');
        });
    }
}
