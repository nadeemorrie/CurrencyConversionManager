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
    public function create()
    {
  //   	$order = new BasicOrder(13.0947, 0);
  //       $order->getTotal(100, false);
		// $order->getConvertedForeignAmount(100);

        return view('pages.order.create', ['user' => 'nadeem']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOne(Request $request)
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try
        // {
        //     if ($request->event=="") {
        //         throw new Exception ("Blank event name entered.");
        //     }

        //     $event = new Event;
        //     $event->name = $request->event;            
        //     $event->user_id = $this->userid;                      

        //     $event->save();

        //     $message = "";        
        //     $message = "Event (".$request->event.") successfully saved.";
        //     flash()->message($message,'success','Event Saved');
        // } 
        // catch (\Exception $e)
        // {   
        //     flash()->message($this->FormatException($e, $request), 'danger', '');  
        // }         
        
        // return redirect('event/create');
    }
}
