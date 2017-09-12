<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tx_events', 
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tx_id')->unsigned();
                $table->date('eventTime');
                $table->string('report');
                $table->timestamps();
                $table->foreign('tx_id')->references('id')->on('transactions')->onDelete('cascade');
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
        Schema::dropIfExists('tx_events');
    }
}
