<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('system_constants', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            
            $table->increments('id');
            $table->string('name',50);
            $table->integer('value');
            $table->string('type',20);
            $table->unique(['value','type']);
            $table->integer('order');
            $table->tinyInteger('status');
            $table->string('value2',50)->nullable();
            $table->string('value3',50)->nullable();
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
        Schema::dropIfExists('system_constants');
    }
}
