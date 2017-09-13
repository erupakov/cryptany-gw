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
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users', 
            function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('first_name')->default('Noname')->nullable(true);
                $table->string('family_name')->default('Acme')->nullable(true);
                $table->string('email')->index();
                $table->string('password')->default('Qwerty123')->nullable(true);
                $table->string('pin')->default('1111')->index();
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
        Schema::dropIfExists('users');
    }
}
