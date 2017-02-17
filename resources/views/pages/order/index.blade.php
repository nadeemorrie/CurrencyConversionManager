@extends('master')


@section('content')
 {{-- Angular Code --}}
<script src="{{url('js/pages/order/index.js')}}"></script>


<div ng-controller="orderController">

<form class="form-horizontal">
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

	<div class="form-group">
		<label for="buyIn" class="col-sm-2 control-label">Purchase amount:</label>
		
		<div class="col-sm-10">
			<label class="radio-inline">
			  <input type="radio" name="buyIn" id="buyInDefaultCurrency" value="baseCurrency">USD
			</label>
			<label class="radio-inline">
			  <input type="radio" name="buyIn" id="buyInForeignCurrency" value="foreignCurrency">Foreign Currency (@{{data.selectedOption.name}})
			</label>			
		</div>
	</div>

	


	<div class="form-group">
		
		<label for="inputBuyAmount" class="col-sm-2 control-label"></label>
		
		<div class="col-sm-10">			
			<input type="number" class="form-control" id="inputBuyAmount" ng-model="data.amount">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2">
			
		</div>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary" ng-disabled="data.validateFields()">Proceed</button>
		</div>
	</div>
			
</form>



</div>



	  		

@stop