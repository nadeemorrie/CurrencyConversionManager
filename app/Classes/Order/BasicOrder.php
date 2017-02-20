<?php

namespace App\Classes\Order;

use App\Classes\Abstracts\Order;

class BasicOrder extends Order {
	
	/**
     * Constructor to initialise variables
     *            
     * @param float $exchangeRate, float $surchargeRate, int $buyAmount
     */
	function __construct($exchangeRate, $surchargeRate) {
		$this->exchangeRate = $exchangeRate;
		$this->surchargeRate = $surchargeRate;				
	}

	/**
     * Total amount to pay
     *        
     * @return int 
     */
	public function getTotal () {		
		return round($this->baseAmount + $this->surchargeAmount, 2);
	}
}
?>