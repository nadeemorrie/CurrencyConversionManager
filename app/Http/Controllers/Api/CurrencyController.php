<?php

namespace App\Http\Controllers\Api;

// Internal classes
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

// Models
use App\Currency;

// Custom classes
use App\Classes\Order\BasicOrder;
use App\Classes\Exchange\Rates;


class CurrencyController extends Controller
{
    /**
     * Api to fetches a list of currencies and its rates    
     *
     * @return json $rates
     */
    public function getRates()
    {
        return (new Rates)->fetchRates();        
    }
    /**
     * Api to fetches a list of currencies and its rates    
     *
     * @return array $currencies
     */
    public function postList(Request $request)
    {
        $sql = "select ";
        $sql .=" c.id, c.baseCode, c.baseCodeSymbol, c.code, c.symbol, c.name as currencyName, ";
        $sql .=" r.id rateId, r.exchange as exchangeRate, r.surcharge surchargeRate, r.surcharge_percent ";
        $sql .=" from currency c ";
        $sql .=" inner join rates r ";
        $sql .=" on c.id = r.currency_id ";
        $sql .=" where c.baseCode = '".$request->currencyCode."' ";

        $currencies = DB::select($sql); 

        // $currencies = Currency::get();

        return $currencies;
    }

    /**
     * Api to calculate totals
     *
     * @return collection totals
     */
    public function postConvert(Request $request)
    {        
        // Fetch form inputs
        $inputAmount=$request->amount;
        $isForeign = $request->isForeign === 'true' ? true: false;
        $exchangeRate = $request->exchangeRate;
        $surchargeRate = $request->surchargeRate;
        
        // create a new order class to calculate the costs
        $order = new BasicOrder($exchangeRate, $surchargeRate);
        
        // set the basee amount. isForeign flag to determine if currency must
        // be converted to base currency.        
        $order->setBaseAmount($inputAmount, $isForeign);
        $baseAmount = $order->getBaseAmount();

        // convert the currency        
        $order->setForeignAmount($inputAmount, $isForeign);        
        $foreignAmount = $order->getForeignAmount();
        
        // get the surcharge amount
        $order->setSurchargeAmount($baseAmount);
        $surcharge=$order->getSurchargeAmount();

        // get the total cost
        $total = $order->getTotal();

        return collect(
            [
                'foreignAmount'=>$foreignAmount,              
                'cost'=>$baseAmount,
                'surcharge'=>$surcharge,
                'total'=>$total
            ]);
    }

   
}
