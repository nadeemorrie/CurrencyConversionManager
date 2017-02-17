@extends('master')


@section('content')
 {{-- Angular Code --}}
<script src="{{url('js/pages/order/create.js')}}"></script>


<div ng-controller="orderController">

	 {{-- {!! Form::open(['method' => 'PATCH', 'route' => ['event.update',$id]]) !!} --}}
	<form class="form-horizontal">
	{{-- <form method="POST" action="{{route('event.store')}}"> --}}
	{{-- <form method="POST" action="{{url('/store')}}/result/competition/22" accept-charset="UTF-8"> --}}
	<input name="_method" type="hidden" value="POST">
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
				     ng-options="option.name for option in data.options track by option.id" 
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
				  ng-model="data.isForeign">Foreign Currency (@{{data.selectedOption.name}})
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
				<button type="submit" class="btn btn-primary" 
				ng-click="data.calculateCurrency()" 
				ng-disabled="data.validateFields()">Proceed</button>
			</div>
		</div>

		<div ng-hide="false" class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<div class="well well-sm">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">					    
								<div class="col-sm-12"><h4>Purchase details</h4></div>
							</div>
							<div class="row">
								<dl class="dl-horizontal">
								  <dt>Currency</dt>
								  	<dd>@{{data.selectedOption.code}} (@{{data.selectedOption.name}})</dd>
								  <dt>@{{data.selectedOption.code}} amount</dt>
								  	<dd>@{{data.selectedOption.symbol}}</dd>
								  <dt>Exchange Rate</dt>
								  	<dd>@{{data.exchangeRate}}</dd>
								  <dt>Cost amount</dt><dd>...</dd>
								  <dt>Surcharge</dt><dd>...</dd>
								  <dt>Total</dt><dd>...</dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>				
	</form>
</div>

@stop