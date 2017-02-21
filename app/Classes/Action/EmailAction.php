<?php

namespace App\Classes\Action;

use Mail;

use App\Classes\Abstracts\Action;

class EmailAction extends Action {

	function __construct() {
	
	}

	protected function process($array) {

		$emails = ['nadeem.orrie@gmail.com'];

		 Mail::send('emails.notice', ['user' => 'test'], function ($m) use ($emails) {
                $m->from(ENV('APP_WEBMASTER_EMAIL'), ENV('APP_WEBMASTER_NAME'));
                $m->to($emails)->subject('New User Registered');
            });
		
		var_dump('send mail', $array);

	}

}

?>