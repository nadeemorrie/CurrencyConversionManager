<?php

namespace App\Classes\Action;

use App\Classes\Abstracts\Action;

class DiscountAction extends Action {

	private $total;

	function __construct($total) {
		$this->total = $total;
	}

	/**
     * Calculate the discount, instruction configured in action table
     *
     * @var array $actions
     * @return array
     */
	protected function process($actions) {
		
		//if no actions found then return zero
		if (!$actions) {
			return array (
				"discount" => NULL,
				"total" => $this->total
			);
		}

		return array (
			"discount" => round($this->total * $actions[0]->discount, 2),
			"total" => round($this->total * (1 - $actions[0]->discount), 2)
			);
	}

}

?>