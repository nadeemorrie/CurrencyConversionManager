<?php

namespace App\Classes\Abstracts;

abstract class Order {	
	protected $exchangeRate;	
	protected $foreignAmount;
	protected $baseAmount;	
	protected $surchargeRate;
	protected $total;		

	protected abstract function getCost($buyAmount, $isForeign);

	/**
     * Get the exchange rate amount for conversion
     *
     * @return string $code
     */
	protected function getExchangeRate() {
		return $this->exchangeRate;
	}

	/**
     * Set the exchange rate amount
     *
     * @return string $code
     */
	protected function setExchangeRate($exchangeRate) {
		return $this->exchangeRate = $exchangeRate;
	}
	
	/**
     * Calculate surchage amount using the surcharge rate.
     *            
     * @return int 
     */
	protected function getSurchageAmount() {		
		return $this->baseAmount * $this->surchargeRate;
	}

	/**
	 * Set the base amount.
     * Determine if the base amount must be converted from
     * a foreign input amount to the base currency. i.e ZAR to USD.
     * @param int $buyAmount 
     * @param bool $isForeign           
     */
	protected function setAmount($buyAmount, $isForeign) {		
		if ($isForeign)
			return $this->convertToBaseCurrencyAmount($buyAmount);

		return $this->setBaseAmount($buyAmount);
	}

	/**
     * Convert amount from foreign to base currency amount. i.e ZAR to USD
     *            
     * @return int 
     */
	protected function convertToBaseCurrencyAmount($amount) {		
		$this->baseAmount = $amount / $this->exchangeRate;
	}

	/**
     * Convert from base currency to foreign amount i.e USD to ZAR
     *
     * @return string
     */
	protected function convertToForeignCurrencyAmount ($amount) {
		return $amount * $this->exchangeRate;
	}

	/**
     * Set base amount
     *            
     * @return int 
     */
	protected function setBaseAmount($amount) {		
		$this->baseAmount = $amount;
	}

	/**
     * Get the base amount 
     *
     * @param decimal
     */
	protected function getBaseAmount() {
		return $this->baseAmount;
	}

	/**
     * Get the foreign amount 
     *
     * @return decimal
     */
	protected function getForeignAmount($amount) {			
		return $this->foreignAmount = $this->convertToForeignCurrencyAmount($amount);
		
	}

	/**
     * Set the total amount to be paid.
     *            
     * @return int 
     */
	protected function setTotal($amount) {		
		$this->total = $amount;
	}

	/**
     * Get the total amount to be paid.
     *            
     * @return int 
     */
	protected function getTotal() {			
		return $this->total;
	}
}

?>