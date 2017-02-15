<?php

namespace App\Classes\Order;

use App\Classes\Abstracts\Order;

class BasicOrder extends Order {

	private $surchargeRate;
	
	/**
     * Constructor to initialise variables
     *            
     * @param float $exchangeRate, float $surchargeRate, int $buyAmount
     */
	function __construct($exchangeRate, $surchargeRate, $buyAmount) {
		$this->exchangeRate = $exchangeRate;
		$this->surchargeRate = $surchargeRate;
		$this->buyAmount = $buyAmount;
	}
	
	/**
     * Calculate surchage amount using the surcharge rate.
     *            
     * @return int 
     */
	protected function getSurchageAmount() {		
		return $this->getConvertedAmount() * $this->surchargeRate;
	}

	/**
     * Total amount to pay
     *        
     * @return int 
     */
	public function getTotalCost () {
		var_dump($this->getConvertedAmount() + $this->getSurchageAmount());
	}

}
?>