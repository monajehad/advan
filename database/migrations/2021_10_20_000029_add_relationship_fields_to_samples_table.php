<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSamplesTable extends Migration
{
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->unsignedBigInteger('sample_id');
            $table->foreign('sample_id', 'sample_fk_5158473')->references('id')->on('sample_stocks');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5095750')->references('id')->on('users');
            $table->unsignedBigInteger('stock_available_id')->nullable();
            $table->foreign('stock_available_id', 'stock_available_fk_5158474')->references('id')->on('sample_stocks');
        });
    }
}
