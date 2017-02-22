<?php

namespace App\Classes\Order;

use App\Classes\Abstracts\Order;

class BasicOrder extends Order {
	
	/**
     * Constructor to initialise variables
     *            
     * @param float $exchangeRate, float $surchargeRate
     */
	function __construct($exchangeRate, $surchargeRate) {
		$this->exchangeRate = $exchangeRate;
		$this->surchargeRate = $surchargeRate;				
	}

	/**
     * Calculate the total amount to pay
     *        
     * @return float 
     */
	public function getTotal () {		
		return round($this->baseAmount + $this->surchargeAmount, 2);
	}

}
?>