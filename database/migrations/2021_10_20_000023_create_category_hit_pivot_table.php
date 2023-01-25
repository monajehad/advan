<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHitPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_hit', function (Blueprint $table) {
            $table->unsignedBigInteger('hit_id');
            $table->foreign('hit_id', 'hit_id_fk_5159901')->references('id')->on('hits')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_5159901')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
