<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSampleStocksTable extends Migration
{
    public function up()
    {
        Schema::table('sample_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_5158472')->references('id')->on('categories');
        });
    }
}
