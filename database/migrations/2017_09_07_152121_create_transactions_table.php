<?php
/**
 * Transactions database table migration file
 * PHP Version 7
 *
 * @category DB
 * @package  Database\Migrations
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Transaction database table migration class, used to setup or destroy database 
 * table
 *
 * @category DB
 * @package  Database\Migrations
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transactions', 
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('txHash')->unique(true);
                $table->float('srcAmount')->nullable(false)->default(0);
                $table->float('dstAmount')->nullable(false)->default(0);
                $table->float('gasAmount')->nullable(false)->default(0);
                $table->integer('srcCurrencyId')->unsigned()->default(4);
                $table->integer('dstCurrencyId')->unsigned()->default(1);
                $table->integer('walletId')->unsigned()->nullable(true);
                $table->integer('sessionId')->unsigned()->nullable(true);
                $table->string('card')->nullable(true);
                $table->string('valDate')->nullable(true);
                $table->integer('status')->unsigned()->default(0);
                $table->timestamps();
                $table->foreign('walletId')->references('id')
                    ->on('wallets')->onDelete('cascade');
                $table->foreign('sessionId')->references('id')
                    ->on('sessions')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
