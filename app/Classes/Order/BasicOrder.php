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
	public function getCost ($buyAmount, $isForeign) {
		$this->setAmount($buyAmount, $isForeign);
		return ($this->getBaseAmount() + $this->getSurchageAmount());
	}

	public function getConvertedForeignAmount ($amount) {
		return ($this->getForeignAmount($amount));
	}
}
?>