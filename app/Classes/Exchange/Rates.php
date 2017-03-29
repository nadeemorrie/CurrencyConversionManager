<?php

namespace App\Classes\Exchange;

// System Classes
use Exception;

// Guzzle Classes
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

// Models
use App\Currency;
use App\Rates as DBRates;

class Rates {

	private $jsonRates;
	private $client;
	private $message;

	public function __construct () {
		// Instantiate a new GuzzleHttp Client
		$this->client = new Client();
		$this->message = collect(['error'=>'','success'=>'']);
	}

	/**
     * Store a new currency rate in the db rates table.
     *
     * @param  array  $rate     
     */
	private function storeNewRate ($rate) {		
		// get foreign codes for the base currency
		$foreignCodes = $this->getForeignCodes(array_get($rate, 'base'));

		// get foreign codes for rates that must be set for a base currency.
		foreach ($foreignCodes as $currency) {
			// set foreign code of the base currency.
			$foreignCode = $currency['code'];
			//set the currency id of the currency.
			$currencyId = $currency['id'];

			// retrieve new rate from array.
			$newRate = array_get($rate, 'rates.'.$foreignCode, 1);

			// save rate in rates table
			DBRates::where('currency_id', $currencyId)
						->update([
							'exchange' => $newRate,
							'updated_at' => date('Y-m-d h:m:i')
							]);
		}
	}

	/**
     * Fetches the forein codes of a base currency
     *
     * @param  string  $baseCode
     * @return collection
     */
	private function getForeignCodes($baseCode) {
		return Currency::where('baseCode',$baseCode)->get();
	}

	/**
     * Setter for $jsonRates
     *
     * @param  int  $jsonRates     
     */
	public function setJsonRates ($jsonRates) {
		$this->jsonRates = $jsonRates;		
	}

	/**
     * Fetches the exchange rates for of a base currency and
     * stores it in the rates table.
     *
     *   @param  null
     *   @return collection
     */
	public function fetchRates() {
		try 
		{			
			$baseCurrencies = $this->getBaseCurrencies();			

			// setup client api to get rates
			$client = new Client();

			// create the request callback
			$requests = function ($total) use ($baseCurrencies) {
			    $uri = 'http://api.fixer.io/latest?base=';
			    foreach ($baseCurrencies as $currency) {
			        yield new Request('GET', $uri.$currency['baseCode']);
			    }
			};
			
			// pool the requests
			$pool = new Pool($client, $requests($baseCurrencies->count()), [
			    'concurrency' => 5,
			    'fulfilled' => function ($response, $index) {

			        // get the response and decode the json to array
			        $rate = json_decode($response->getBody()->getContents(),true);

			        // store new rate
			        $this->storeNewRate($rate);

			        // set success message
			        $this->message->put('success','Rates updated successfully.');

			        // set the udpated_at date message
			        $this->message->put('updated_at', DBRates::max('updated_at'));
			    },
			    'rejected' => function ($reason, $index) {			        
			        $this->message->put('error','Rates updated error.<br>'.$reason);
			    },
			]);

			// Initiate the transfers and create a promise
			$promise = $pool->promise();

			// Force the pool of requests to complete.
			$promise->wait();

			// return the status of setting the rates to the user.
			return $this->message;
		}
		catch (Exception $e)
		{	
			// set the error message
			$this->message->put('error','Rates system error.<br>'.$e->getMessage());

			return $this->message;
		}	
	}

	/**
     * Fetches base codes stored in the Currency table.
     *
     *   @return collection  
     */
	private function getBaseCurrencies() {
		return Currency::select('baseCode')->groupBy('baseCode')->get();
	}

}

?>
