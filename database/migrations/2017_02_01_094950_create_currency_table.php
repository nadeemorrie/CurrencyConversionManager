<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('currency'))
            return;

        Schema::create('currency', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->char('baseCode', 3);
            $table->char('code', 3);
            $table->char('symbol', 1);
            $table->string('name', 50);
            $table->timestamps();
            $table->primary('id','baseCode', 'code');
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
        Schema::dropIfExists('currency');
    }
}
