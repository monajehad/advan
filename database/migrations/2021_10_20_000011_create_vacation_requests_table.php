<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('days');
            $table->date('start_time');
            $table->date('end_date')->nullable();
            $table->longText('reason');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
