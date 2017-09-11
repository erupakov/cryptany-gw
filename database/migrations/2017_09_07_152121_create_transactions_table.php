<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txHash')->unique(true);
            $table->float('srcAmount')->nullable(false);
            $table->float('dstAmount')->nullable(false);
            $table->float('gasAmount')->nullable(false);
            $table->integer('srcCurrencyId')->unsigned();
            $table->integer('dstCurrencyId')->unsigned();
            $table->integer('walletId')->unsigned();
			$table->integer('sessionId')->unsigned();
			$table->integer('status')->unsigned()->default(0);
            $table->timestamps();
            $table->foreign('walletId')->references('id')->on('wallets')->onDelete('cascade');
            $table->foreign('sessionId')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
