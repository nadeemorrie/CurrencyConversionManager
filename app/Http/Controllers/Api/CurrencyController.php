<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Currency;
use App\Classes\Order\BasicOrder;


class CurrencyController extends Controller
{
    /**
     * Api to fetches a list of currencies     
     *
     * @return model
     */
    public function getIndex()
    {
        $currencies = Currency::get();

        return $currencies;
    }

    /**
     * Api to fetches a list of currencies     
     *
     * @return model
     */
    public function postConvert(Request $request)
    {
        $buyAmount=$request->amount;
        $isForeign = $request->isForeign;

        // $surchargeRate
        // $exchangeRate

        $rate = 13.0947;
        $order = new BasicOrder(13.0947, 0);
        $cost = $order->getCost($buyAmount, $isForeign);
        $foreignAmount = $order->getConvertedForeignAmount($buyAmount);

        return collect(
            [
                'cost'=>$cost,
                'foreignAmount'=>$foreignAmount,
                'exchangeRate'=>$rate             
            ]);
    }

   
}
