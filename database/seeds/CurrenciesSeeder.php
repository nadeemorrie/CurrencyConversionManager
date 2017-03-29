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
            'baseCode'=>'ZAR',
            'baseCodeSymbol'=>'R',
            'name'=>'United Snakes Dollars',
            'code'=>'USD',
            'symbol'=>'$'
        ], [
            'id'=>6,
            'baseCode'=>'ZAR',
            'baseCodeSymbol'=>'R',
            'name'=>'British Pound',
            'code'=>'GBP',
            'symbol'=>'£'
        ],[
            'id'=>7,
            'baseCode'=>'ZAR',
            'baseCodeSymbol'=>'R',
            'name'=>'Euro',
            'code'=>'EUR',
            'symbol'=>'€'
        ],[
            'id'=>8,
            'baseCode'=>'ZAR',
            'baseCodeSymbol'=>'R',
            'name'=>'Kenyan Shilling',
            'code'=>'KES',
            'symbol'=>'KSh'
        ]];

        DB::table('currency')->insert($currencyArray);

        $ratesArray = [[
                    'currency_id' => 1,
                    'exchange' => '13.0947',
                    'surcharge' => 0.02,
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
                    'surcharge' => 0.2,
                    'surcharge_percent' => 2
                ],[
                    'currency_id' => 5,
                    'exchange' => 10.0947,
                    'surcharge' => 0.06,
                    'surcharge_percent' => 6
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
                    'surcharge' => 0.03,
                    'surcharge_percent' => 3
                ]];

        DB::table('rates')->insert($ratesArray);


        $actionsArray = [[
                    'currency_id' => 1,
                    'type' => NULL,
                    'discount' => NULL,
                    'email' => NULL
                ], [
                    'currency_id' => 2,
                    'type' => 'email',
                    'discount' => NULL,
                    'email' => 'nadeem.orrie@gmail.com'
                ],[
                    'currency_id' => 3,
                    'type' => 'discount',
                    'discount' => 0.10,
                    'email' => NULL
                ]];

        DB::table('actions')->insert($actionsArray);
    }
}
