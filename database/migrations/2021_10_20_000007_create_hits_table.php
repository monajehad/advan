<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitsTable extends Migration
{
    public function up()
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date_time')->nullable();
            $table->string('duration_visit')->nullable();
            $table->string('number_samples')->nullable();
            $table->string('address')->nullable();
            $table->string('report_type')->nullable();
            $table->string('report_status')->nullable();
            $table->longText('note')->nullable();
            $table->longText('sms_message')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
