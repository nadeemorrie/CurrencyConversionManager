<?php

namespace App\Classes\Action;

use Mail;
use Exception;

use App\Classes\Abstracts\Action;

class EmailAction extends Action {

	function __construct() {
	
	}

	protected function process($actions) {		
		//if no actions found then exit function
		if (!$actions)
			return;

		$emails = [$actions[0]->email];
		$currencyName = $actions[0]->currencyName;

		try
		{
			// very basic email. works with mandril, see .env config
			$result = Mail::send(
				'emails.notice',
				['currencyName' => $currencyName],
				function ($m) use ($emails, $currencyName) {
		            $m->from(ENV('APP_WEBMASTER_EMAIL'), ENV('APP_WEBMASTER_NAME'));
		            $m->to($emails)->subject('New Currency Purchased ('.$currencyName.')');
	        	}
	        );
		}
		catch (Exception $e) {
			dd("Possible mail error:", $e->getMessage());
		}
		

	}

}

?>