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

  <div class="form-group">
    <label for="inputFullName" class="col-sm-2 control-label">Full Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFullName" placeholder="Full Name">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
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
			<select class="form-control" id="inputCurrency" ng-model="selectedCurrency">
			    <option value="">Select currency</option>
			    <option ng-repeat="item in currencies" value="@{{item.id}}">@{{item.name}}</option>		    
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="buyIn" class="col-sm-2 control-label">Buy in:</label>
		
		<div class="col-sm-10">
			<label class="radio-inline">
			  <input type="radio" name="buyIn" id="buyInDefaultCurrency" value="option1"> USD
			</label>
			<label class="radio-inline">
			  <input type="radio" name="buyIn" id="buyInForeignCurrency" value="option2"> @{{currencies[selectedCurrency]}}
			</label>			
		</div>
	</div>

	


	<div class="form-group">
		
		<label for="inputBuyAmount" class="col-sm-2 control-label">Buy Amount (USD)</label>
		
		<div class="col-sm-10">			
			<input type="text" class="form-control" id="inputBuyAmount" placeholder="USD">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2">
			
		</div>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary">Proceed</button>
		</div>
	</div>
			
</form>



</div>



	  		

@stop