<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVacationRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('vacation_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5088398')->references('id')->on('users');
        });
    }
}
