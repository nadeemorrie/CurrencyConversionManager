<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classes\Order\BasicOrder;

class BuyCurrencyController extends Controller
{
  	/**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function index()
    {
    	$order = new BasicOrder(13.14, 0, 50);
		$order->getTotalCost();

        return view('pages.order.index', ['user' => 'nadeem']);
    }
}
