<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
