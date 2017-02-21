@extends('master')


@section('content')

<div class="row">
	<div class="col-sm-2"> 
	</div>
	<div class="col-sm-10"> 
		<div class="alert alert-success" role="alert">
	  	<a href="#" class="alert-link">Your order was successfully captured.</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-2"> 
	</div>
	<div class="col-sm-10"> 
		<div class="panel panel-default">
		  <div class="panel-body">
		    <dl class="dl-horizontal">
				<dt>Foreign currency:</dt>
				    <dd>{{$foreignCurrencyCode}}</dd>
			    <dt>Exchange rate:</dt>
			    	<dd>{{$exchangeRate}}</dd>
			    <dt>Surcharge:</dt>
			    	<dd>{{$surchargePercent}}%</dd>
			    <dt>Currency Purchased:</dt>
			    	<dd>{{$currencyPurchasedSymbol}}{{$currencyPurchased}}</dd>
			</dl>
			<dl class="dl-horizontal">
			    <dt>Cost ({{$baseCode}}):</dt>
			    	<dd>{{$baseCodeSymbol}}{{$cost}}</dd>
			    <dt>Surcharge ({{$baseCode}}):</dt>
			    	<dd>{{$baseCodeSymbol}}{{$surcharge}}</dd>
			    @if ($discount)
			    <dt>Discount ({{$baseCode}}):</dt>
			    	<dd>{{$baseCodeSymbol}}-{{$discount}}</dd>
			    @endif
			    <dt>Total ({{$baseCode}}):</dt>
			    	<dd>{{$baseCodeSymbol}}{{$total}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Date created:</dt>
				    <dd>{{ date('d M Y H:m', strtotime($createdAt))}}</dd>
			</dl>
		  </div>
		</div>
	</div>
</div>

@stop