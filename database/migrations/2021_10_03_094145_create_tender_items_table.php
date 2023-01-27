<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('tender_items', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->integer('item_quantity');
            $table->integer('supplied_quantity')->default(0);
            $table->double('item_price');
            $table->tinyInteger('unit')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('trade_name',255)->nullable();
            $table->tinyInteger('price_accepted')->nullable()->comment('0-> not accepted , 1 ->accepted');
            $table->tinyInteger('accepted_item')->nullable()->comment('0-> not accepted , 1 ->accepted');

            $table->enum('type',[1,2])->comment('1-> tender items , 2-> tender items pricing');
            $table->unsignedInteger('tender_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            
            $table->index('price_accepted');
            $table->index('accepted_item');
            $table->index('type');
            $table->index('tender_id');
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
        Schema::dropIfExists('tender_items');
    }
}
