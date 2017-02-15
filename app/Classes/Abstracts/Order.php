<?php

namespace App\Classes\Abstracts;

abstract class Order {

	protected $baseCurrency;
	protected $exchangeCurrency;
	protected $exchangeRate;
	protected $buyAmount;
	protected $convertedAmount;

	protected abstract function getTotalCost();

	/**
     * Set the default purchase currency. default is USD.
     *
     * @param  base currency code.          
     */
	protected function setDefaultBaseCurrencyCode($baseCurrency) {
		$this->baseCurrency = $baseCurrency; 
	}

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
     * Get the buy amount 
     *     
     * @return decimal
     */
	protected function getBuyAmount() {
		return $this->buyAmount;
	}

	/**
     * Set the buy amount 
     *
     * @param decimal
     */
	protected function setBuyAmount($amount) {
		$this->buyAmount = $amount;
	}

	/**
     * Calculate the converted amount 
     *
     * @return decimal
     */
	protected function getConvertedAmount() {
		$this->setConvertedAmount();
		return $this->convertedAmount;
	}

	/**
     * Calculate the converted amount 
     *
     * @return string
     */
	protected function setConvertedAmount () {
		$this->convertedAmount = $this->buyAmount * $this->exchangeRate;
	}
}

?>