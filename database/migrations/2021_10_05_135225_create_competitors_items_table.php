<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('competitors_items', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->double('item_price');
            $table->unsignedInteger('tender_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('competitor_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade')->onUpdate('cascade');
            // $table->unique(['tender_id','item_id','competitor_id']);
            $table->index('tender_id');
            $table->index('competitor_id');
            $table->index('item_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitors_items');
    }
}
