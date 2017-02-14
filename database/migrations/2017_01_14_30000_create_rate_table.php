<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
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
            $table->unsignedSmallInteger('currency_id');
            $table->float('exchange', 8,8);
            $table->float('surcharge', 8,8);
            $table->float('surcharge_percent', 8,8);            
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
