@extends('master')


@section('content')
 {{-- Angular Code --}}
<script src="{{url('js/pages/order/create.js')}}"></script>


<div ng-controller="orderController">

	 
	<form class="form-horizontal" method="POST" action="{{route('order.store')}}">	
		{!! csrf_field() !!}
		<div class="form-group">
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-10">
				<h4>Customer</h4>
			</div>
		</div>

	  <div class="form-group @{{data.hasFullname()}}">
	    <label for="inputFullName" class="col-sm-2 control-label">Full Name</label>
	    <div class="col-sm-10">      
	      <input type="text" class="form-control" ng-model="data.fullname"
	      id="inputFullName" placeholder="Full Name">
	    </div>
	  </div>

	  <div class="form-group @{{data.hasEmail()}}">
	    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" ng-model="data.email" 
	      id="inputEmail" placeholder="Email">
	    </div>
	  </div>  

		<div class="form-group">
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-10">
				<h4>Order</h4>
			</div>
		</div>
		{{-- @foreach ($test=@{{currencies}} as $data) 
		@endforeach --}}
		<div class="form-group">
			<label for="inputCurrency" class="col-sm-2 control-label">Buy Currency</label>
			
			<div class="col-sm-10">
				<select class="form-control" name="inputCurrency" id="inputCurrency" 
				     ng-options="option.currencyName for option in data.options track by option.id" 
					 ng-model="data.selectedOption">			    
				</select>
			</div>
		</div>

		<div class="form-group @{{data.hasPurchaseType()}}">
			<label for="buyIn" class="col-sm-2 control-label">Purchase amount:</label>
			
			<div class="col-sm-10">
				<label class="radio-inline">
				  <input type="radio" name="buyIn" id="buyInDefaultCurrency" value="false" 
				  ng-model="data.isForeign">USD
				</label>
				<label class="radio-inline">
				  <input type="radio" name="buyIn" id="buyInForeignCurrency" value="true" 
				  ng-model="data.isForeign">Foreign Currency (@{{data.selectedOption.currencyName}})
				</label>			
			</div>
		</div>

		<div class="form-group @{{data.hasAmount()}}">
			
			<label for="inputBuyAmount" class="col-sm-2 control-label"></label>
			
			<div class="col-sm-10">			
				<input type="number" class="form-control" id="inputBuyAmount" ng-model="data.amount">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-10">
				<button type="button" class="btn btn-primary" 
				ng-click="data.calculateCurrency()" 
				ng-disabled="data.validateFields()">Next</button>
			</div>
		</div>

		<div ng-hide="data.hideBuyDiv" class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<div class="well well-sm">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">					    
								<div class="col-sm-12"><h4>Order..</h4></div>
							</div>
							<div class="row">
								<dl class="dl-horizontal">
								  <dt>Currency</dt>
								  	<dd>@{{data.selectedOption.code}} (@{{data.selectedOption.currencyName}})</dd>
								  <dt>Buy </dt>
								  	<dd>@{{data.selectedOption.symbol}}@{{data.foreignAmount}}</dd>
								  <dt>Exchange Rate</dt>
								  	<dd>@{{data.selectedOption.exchangeRate}}</dd>
								</dl>
								<dl class="dl-horizontal">
								  <dt>Cost (@{{data.selectedOption.baseCode}})</dt>
								  	<dd>@{{data.selectedOption.baseCodeSymbol}}@{{data.cost}}</dd>
								  <dt>Surcharge (@{{data.selectedOption.baseCode}})</dt>
								  	<dd>@{{data.selectedOption.baseCodeSymbol}}@{{data.surcharge}}</dd>
								  <dt>Total (@{{data.selectedOption.baseCode}})</dt>
								  	<dd>@{{data.selectedOption.baseCodeSymbol}}@{{data.total}}</dd>
								</dl>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-2">
										
									</div>
									<div class="col-sm-10">
										{!! csrf_field() !!}
										<input type="hidden" name="currencyId" value="@{{data.selectedOption.id}}">
										<input type="hidden" name="currencyCode" value="@{{data.selectedOption.code}}">
										<input type="hidden" name="currencyBaseCode" value="@{{data.selectedOption.baseCode}}">
										<input type="hidden" name="rateId" value="@{{data.selectedOption.rateId}}">
										<input type="hidden" name="surcharge" value="@{{data.surcharge}}">
										<input type="hidden" name="cost" value="@{{data.cost}}">
										<input type="hidden" name="total" value="@{{data.total}}">
										<input type="hidden" name="foreignAmount" value="@{{data.foreignAmount}}">
										<input type="hidden" name="customerName" value="@{{data.fullname}}">
										<input type="hidden" name="customerEmail" value="@{{data.email}}">
										<button type="submit" class="btn btn-success">Buy</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>				
	</form>
</div>
@stop