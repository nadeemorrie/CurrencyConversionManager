<?php
	namespace App\Classes\Abstracts;

	use DB;

	abstract class Action {

		protected abstract function process($actionArray);

		public function run($params) {

			return $this->process($this->getActionsArray($params));

		}

		/**
	     * Get the actions related to a currency
	     * @param string $currencyCode
	     * @return array
	     */
		protected function getActionsArray($params) {

			$sql=" select ";
			$sql.=" c.id,c.baseCode, c.baseCodeSymbol, c.code, c.symbol, c.name as currencyName, ";
			$sql.=" a.type, a.email, a.discount ";
			$sql.=" from currency c ";
			$sql.=" inner join actions a ";
			$sql.=" on c.id = a.currency_id ";
			$sql.=" where c.baseCode = '".$params["baseCode"]."' ";
			$sql.=" and c.code='".$params["currencyCode"]."' ";
			$sql.=" and a.type='".$params["type"]."' ";

			$actionsArray = DB::select($sql);
			
			return $actionsArray;
		}
	
	}


?>