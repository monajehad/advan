<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('tenders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->increments('id');
            $table->tinyInteger('guarantee_type');
            $table->string('tender_no',30);
            $table->tinyInteger('tender_type')->nullable();
            $table->float('guarantee_rate');
            $table->float('guarantee_value')->nullable();
            $table->tinyInteger('guarantee_status')->default(0);
            $table->string('guarantee_no',30)->nullable();
            $table->string('guarantee_file',255)->nullable();
            $table->double('transfer_price');
            $table->tinyInteger('currency');
            $table->tinyInteger('tax');
            $table->string('tender_file',255);
            $table->date('representation_date');
            $table->date('notification_receipt_date')->nullable();
            $table->string('manager',255)->nullable();
            $table->string('notification_file')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('user_id');

            $table->index('client_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tenders');
    }
}
