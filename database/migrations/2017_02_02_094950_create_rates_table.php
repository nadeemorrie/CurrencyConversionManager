<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('rates'))
            return;

        Schema::create('rates', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedInteger('currency_id')->unique();
            $table->double('exchange');
            $table->double('surcharge');
            $table->double('surcharge_percent');            
            $table->timestamps();
            
            $table->foreign('currency_id')->references('id')->on('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('rates');
    }
}
