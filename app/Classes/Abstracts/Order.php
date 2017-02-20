<?php

namespace App\Classes\Abstracts;

abstract class Order {	
	protected $exchangeRate;	
	protected $foreignAmount;
	protected $baseAmount;	
	protected $surchargeRate;
	protected $surchargeAmount;
	protected $total;		

	protected abstract function getTotal();

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
     * Calculate and set surchage amount using the surcharge rate.
     *                 
     */
	public function setSurchargeAmount($baseAmount) {		
		$this->surchargeAmount = round($baseAmount * $this->surchargeRate, 2);
	}

	/**
     * Get surchage amount using the surcharge rate.
     *            
     * @return float 
     */
	public function getSurchargeAmount() {		
		return $this->surchargeAmount;
	}

	/**
     * Convert amount from foreign to base currency amount. i.e ZAR to USD
     *            
     * @return float 
     */
	protected function convertToBaseCurrencyAmount($amount) {		
		return round($amount / $this->exchangeRate, 2);
	}

	/**
     * Convert from base currency to foreign amount i.e USD to ZAR
     *
     * @return string
     */
	protected function convertToForeignCurrencyAmount ($amount) {
		return round($amount * $this->exchangeRate, 2);
	}

	/**
     * Get foreing amount
     *            
     * @return float 
     */
	public function getForeignAmount() {		
		return $this->foreignAmount;
	}

	/**
     * Set the foreign amount 
     *
     * @return float
     */
	public function setForeignAmount($amount, $isForeign) {
		if ($isForeign) {
			$this->foreignAmount = round($amount, 2);
			return;
		}			
		$this->foreignAmount = $this->convertToForeignCurrencyAmount($amount);
	}

	/**
     * Set base amount
     *            
     * @return float 
     */
	public function getBaseAmount() {		
		return $this->baseAmount;
	}

	/**
     * Set the base amount based on user input. If its the foreign amount, it needs to 
     * be converted to the base currency amount
     *
     * @return float
     */
	public function setBaseAmount($amount, $isForeign) {
		if ($isForeign) {
			$this->baseAmount = $this->convertToBaseCurrencyAmount($amount);
			return;		
		}
		$this->baseAmount = $amount;
	}

}

?>