<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'wallets', 
            function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('privateKey');
                $table->string('publicKey');
                $table->string('address')->index();
                $table->string('wif');
                $table->boolean('isActive')->index();
                $table->date('expirationTime')->index();
                $table->integer('userId')->unsigned();
                $table->integer('apiUserId')->unsigned();            
                $table->integer('type')->unsigned()->default(1);
                $table->timestamps();
                $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('apiUserId')->references('id')->on('api_users')->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
