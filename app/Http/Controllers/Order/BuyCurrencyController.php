<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classes\Order\BasicOrder;
use App\Order;
use App\Customer;
use DB;

class BuyCurrencyController extends Controller
{
  	/**
     * craete a new order form
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.order.create');
    }


    /**
     * Store a new order for a customer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customerId = null;

        // get single customer if exists        
        $existingCustomer = Customer::where('email', $request->customerEmail)->first();

        //save a new customer
        if (!$existingCustomer) {
            $customer = new Customer;

            $customer->name = $request->customerName;
            $customer->email = $request->customerEmail;

            $customer->save();

            $customerId = $customer->id;
        }

        if ($existingCustomer) {
            $customerId = $existingCustomer->id;
        }

        $order = new Order;

        $order->customer_id = $customerId;
        $order->rate_id = $request->rateId;
        $order->foreign_amount = $request->foreignAmount;
        $order->cost = $request->cost;
        $order->surcharge = $request->surcharge;
        $order->total = $request->total;

        $order->save();
       
        return redirect()->route('order.show',['id'=>$order->id]);
    }

    /**
     * Show the newly captured order.
     *
     * @return Response
     */
    public function show($id)
    {
        $sql=" select ";
        $sql.="c.name customer_name,c.email, o.foreign_amount, o.cost, o.surcharge, o.total, o.created_at, ";
        $sql.="y.baseCode, y.baseCodeSymbol, y.code currencyCode, y.name currencyName, y.symbol, ";
        $sql.="r.exchange, r.surcharge_percent ";
        $sql.="from orders o ";
        $sql.="inner join customers c  ";
        $sql.="on o.customer_id = c.id ";
        $sql.="inner join rates r ";
        $sql.="on r.id = o.rate_id ";
        $sql.="inner join currency y ";
        $sql.="on y.id = r.currency_id ";
        $sql.="where o.id=".$id;

        $order = DB::select($sql);
        
        $customerName = "";
        $customerEmail = "";
        $foreignAmount = 0;
        $cost = 0;
        $surcharge = 0;
        $total = 0;
        $createdAt = "";

        foreach ($order as $value) {            
            $customerName = $value->customer_name;
            $customerEmail = $value->email;
            $foreignAmount = $value->foreign_amount;
            $cost = $value->cost;
            $surcharge = $value->surcharge;
            $total = $value->total;
            $createdAt = $value->created_at;
            $foreignCurrencyCode = $value->currencyCode;
            $exchangeRate = $value->exchange;
            $surchargePercent = $value->surcharge_percent;
            $currencyPurchased = $value->foreign_amount;
            $currencyPurchasedSymbol = $value->symbol;
            $totalCost = $value->total;
            $surcharge = $value->surcharge;
            $baseCode = $value->baseCode;
            $baseCodeSymbol = $value->baseCodeSymbol;            
        }
        
        return view('pages.order.show')->with(
            compact(
                'customerName', 'customerEmail', 'foreignAmount',
                'cost', 'surcharge', 'total', 'createdAt', 'foreignCurrencyCode',
                'exchangeRate', 'surchargePercent', 'currencyPurchased', 'currencyPurchasedSymbol',
                'total', 'surchage', 'baseCode','baseCodeSymbol', 'createdAt'
                )
            );
    }
}
