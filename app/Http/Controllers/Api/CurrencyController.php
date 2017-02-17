<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Fetches a list of currencies     
     *
     * @return model
     */
    public function getIndex()
    {
        $currencies = Currency::get();

        return $currencies;
    }
}
