<?php
/**
 * APIUser database table migration file
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
 * APIUser database table migration
 *
 * @category DB
 * @package  Database\Migrations
 * @author   Eugene Rupakov <eugene.rupakov@gmail.com>
 * @license  Apache Common License 2.0
 * @link     http://cgw.cryptany.io
 */
class CreateApiusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'api_users', 
            function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('username')->index();
                $table->string('description');
                $table->date('expiryDate')->index();
                $table->string('appToken')->unique(true);
                $table->boolean('useTestChain')->default(true);
                $table->boolean('isActive')->default(false);
                $table->timestamps();
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
        Schema::dropIfExists('api_users');
    }
}
