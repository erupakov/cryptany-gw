<?php
/**
 * User database table migration file
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
 * User database table migration class, used to setup or destroy database table
 *
 * @category DB
 * @package  Database\Migrations
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
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
                $table->foreign('userId')->references('id')
                    ->on('users')->onDelete('cascade');
                $table->foreign('apiUserId')->references('id')
                    ->on('api_users')->onDelete('cascade');
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
