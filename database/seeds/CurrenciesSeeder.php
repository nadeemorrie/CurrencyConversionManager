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
        
        $currencyArray = [[
            'name'=>'South African Rand',
            'code'=>'ZAR',
            'symbol'=>'R'
        ], [
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'P'
        ],[
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'E'
        ],[
            'name'=>'Kenyan Shilling',
            'code'=>'KES',
            'symbol'=>'S'
        ]];

        foreach ($currencyArray as $data) {
            $code = $data['code'];

            $currencyRow = DB::table('currency')->where('code', $code)->first();

            $currencyId="";

            if ($currencyRow==null) {
                DB::table('currency')->insert([
                    'code' => $code,
                    'symbol' => $data['symbol'],
                    'name' => $data['name'],
                ]);

                $currencyId = DB::table('currency')->max('id');

                $surcharge = rand(500, 1000) / 100;
                $surchargePercent = rand(0,100);

                DB::table('rates')->insert([
                    'currency_id' => $currencyId,
                    'exchange' => rand(50, 100) / 100,
                    'surcharge' => $surcharge,
                    'surcharge_percent' => $surchargePercent,
                ]);

            }

            $customerArray = [[
                'name'=>'Nadeem Orrie',                
                'email'=>'nadeem@gmail.com'
            ], [
                'name'=>'Sarah Adamse',                
                'email'=>'sara@gmail.com'
            ]];

            foreach ($customerArray as $person) {

                // $rateId = DB::table('rates')->max('id');

                $personName = $person["name"];
                $email = $person["email"];

                $customerRow = DB::table('customers')->where('email', $email)->first();

                if ($customerRow==null) {
                    DB::table('customers')->insert([
                        'name' => $personName,
                        'email' => $email,            
                    ]);
                }

                $customerRow = DB::table('customers')->where('email', $email)->first();
                $customerId = $customerRow->id;

                $rateId = DB::table('rates')->max('id');
                $ratesRow = DB::table('rates')->where('id', $rateId)->first();
                $tempSurcharge = $ratesRow->surcharge;

                $purchaseAmount  = mt_rand(2000000,4000000);
                $surchargeAmount = $purchaseAmount * ($tempSurcharge/100);
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
        
         
    }
}
