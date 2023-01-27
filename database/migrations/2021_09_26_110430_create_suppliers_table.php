<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_second')->create('suppliers', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->increments('id');
            $table->string('ar_name',255)->nullable();
            $table->string('en_name',255)->nullable();
            $table->string('email',255)->unique()->nullable();
            $table->string('mobile',30)->unique();
            $table->string('phone',30)->nullable()->unique();
            $table->string('address',255)->nullable();
            $table->tinyInteger('status');
            $table->unsignedInteger('user_id');
            $table->index('ar_name');
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
        Schema::dropIfExists('suppliers');
    }
}
