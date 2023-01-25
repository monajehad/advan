<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHitsTable extends Migration
{
    public function up()
    {
        Schema::table('hits', function (Blueprint $table) {
            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id', 'clinic_fk_5091107')->references('id')->on('clinics');
            $table->unsignedBigInteger('visit_type_id');
            $table->foreign('visit_type_id', 'visit_type_fk_5158516')->references('id')->on('hits_types');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5091115')->references('id')->on('users');
            $table->unsignedBigInteger('sms_id')->nullable();
            $table->foreign('sms_id', 'sms_fk_5091117')->references('id')->on('kinds_of_occasions');
        });
    }
}
