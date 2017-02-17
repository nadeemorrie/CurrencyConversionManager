<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('orders'))
            return;

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');            
            $table->unsignedSmallInteger('rate_id');  
            $table->double('amount', 15,8);  
            $table->double('surcharge', 15,8);  
            $table->double('total', 15,8);  
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('rate_id')->references('id')->on('rates');
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
        Schema::dropIfExists('orders');
    }
}
