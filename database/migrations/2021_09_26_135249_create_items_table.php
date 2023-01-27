<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('items', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->increments('id');
            $table->string('item_no',30)->unique();
            $table->string('name',255);
            $table->string('delivery_number',255);
            $table->integer('unit');
            $table->tinyInteger('currency');
            $table->float('price')->nullable();
            $table->float('quantity')->nullable();
            $table->date('expired_at');
            $table->tinyInteger('status');
            $table->unsignedInteger('user_id');
            $table->index('name');
            $table->index('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('items');
    }
}
