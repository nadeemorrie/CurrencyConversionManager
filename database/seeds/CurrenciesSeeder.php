<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $exchangeCode = str_random(3);

        DB::table('currency')->insert([
            'code' => $exchangeCode,
            'symbol' => str_random(1),
            'name' => "CurName ".str_random(10),
        ]);

        $currency_id = DB::table('currency')->max('id');

        $surcharge = rand(500, 1000) / 100;
        $surchargePercent = rand(0,100);

        DB::table('rates')->insert([
            'currency_id' => $currency_id,
            'exchange' => rand(50, 100) / 100,
            'surcharge' => $surcharge,
            'surcharge_percent' => $surchargePercent,
        ]);

        $rateId = DB::table('rates')->max('id');

        $personName = str_random(10);

        DB::table('customers')->insert([
            'name' => $personName,
            'email' => $personName.'@gmail.com',            
        ]);

        $customerId = DB::table('customers')->max('id');
        $purchaseAmount  = mt_rand(2000000,4000000);
        $surchargeAmount = $purchaseAmount * ($surcharge/100);
        $total = $purchaseAmount+$surchargeAmount;

        DB::table('orders')->insert([
            'customer_id' => $customerId,
            'rate_id' => $rateId,            
            'amount' => $purchaseAmount,
            'surcharge' => $surchargeAmount,
            'total'=> $total,
        ]);
         
    }
}
