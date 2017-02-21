<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('actions'))
            return;

        Schema::create('actions', function (Blueprint $table) {            
            $table->increments('id');
            $table->unsignedInteger('currency_id');                        
            $table->enum('type', ['email','discount'])->nullable()->default(NULL);  
            $table->double('discount')->nullable()->default(NULL);
            $table->string('email')->nullable()->default(NULL);            
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
    }
}
