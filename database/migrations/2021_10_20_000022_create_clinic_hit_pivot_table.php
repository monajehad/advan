<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicHitPivotTable extends Migration
{
    public function up()
    {
        Schema::create('clinic_hit', function (Blueprint $table) {
            $table->unsignedBigInteger('hit_id');
            $table->foreign('hit_id', 'hit_id_fk_5159902')->references('id')->on('hits')->onDelete('cascade');
            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id', 'clinic_id_fk_5159902')->references('id')->on('clinics')->onDelete('cascade');
        });
    }
}
