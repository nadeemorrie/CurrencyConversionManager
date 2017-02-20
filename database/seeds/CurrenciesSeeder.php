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
            'id'=>1,
            'baseCode'=>'USD',
            'baseCodeSymbol'=>'$',
            'name'=>'South African Rand',
            'code'=>'ZAR',
            'symbol'=>'R'
        ], [
            'id'=>2,
            'baseCode'=>'USD',
            'baseCodeSymbol'=>'$',
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'£'
        ],[
            'id'=>3,
            'baseCode'=>'USD',
            'baseCodeSymbol'=>'$',
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'€'
        ],[
            'id'=>4,
            'baseCode'=>'USD',
            'baseCodeSymbol'=>'$',
            'name'=>'Kenyan Shilling',
            'code'=>'KES',
            'symbol'=>'KSh'
        ],[
            'id'=>5,
            'baseCode'=>'RSA',
            'baseCodeSymbol'=>'R',
            'name'=>'United Snakes Dollars',
            'code'=>'USD',
            'symbol'=>'$'
        ], [
            'id'=>6,
            'baseCode'=>'RSA',
            'baseCodeSymbol'=>'R',
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'£'
        ],[
            'id'=>7,
            'baseCode'=>'RSA',
            'baseCodeSymbol'=>'R',
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'€'
        ],[
            'id'=>8,
            'baseCode'=>'RSA',
            'baseCodeSymbol'=>'R',
            'name'=>'Kenyan Shilling',
            'code'=>'KES',
            'symbol'=>'KSh'
        ]];

        DB::table('currency')->insert($currencyArray);

        $ratesArray = [[
                    'currency_id' => 1,
                    'exchange' => '13.0947',
                    'surcharge' => 2,
                    'surcharge_percent' => 2
                ], [
                    'currency_id' => 2,
                    'exchange' => '0.805058',
                    'surcharge' => 0.5,
                    'surcharge_percent' => 5
                ],[
                    'currency_id' => 3,
                    'exchange' => 0.938787,
                    'surcharge' => 0.10,
                    'surcharge_percent' => 10
                ],[
                    'currency_id' => 4,
                    'exchange' => 103.538,
                    'surcharge' => 0.02,
                    'surcharge_percent' => 2
                ],[
                    'currency_id' => 5,
                    'exchange' => 10.0947,
                    'surcharge' => 2,
                    'surcharge_percent' => 2
                ], [
                    'currency_id' => 6,
                    'exchange' => 2,
                    'surcharge' => 0.5,
                    'surcharge_percent' => 5
                ],[
                    'currency_id' => 7,
                    'exchange' => 3,
                    'surcharge' => 0.10,
                    'surcharge_percent' => 10
                ],[
                    'currency_id' => 8,
                    'exchange' => 50.56,
                    'surcharge' => 0.02,
                    'surcharge_percent' => 2
                ]];

        DB::table('rates')->insert($ratesArray);
/*
        DB::table('currency')->insert([
                    'code' => $code,
                    'symbol' => $data['symbol'],
                    'name' => $data['name'],
                ]);

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
        
         */
    }
}
