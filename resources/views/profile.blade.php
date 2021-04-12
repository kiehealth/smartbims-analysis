<x-riscc-layout>

<div class="card-deck mb-3 text-center profile-card">
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">{{__('lang.my-details')}}</h4>
		</div>
		@if(session('user_profile_updated'))
			<div class="alert alert-success">{{ session('user_profile_updated') }}</div>
		@endif
		{{--<div id="address">--}}
			<div class="card-body" id="address">
				<h3 class="card-title pricing-card-title">
					{{__('lang.address')}} {{--<small class="text-muted">/ mo</small>--}}
				</h3>
				<ul class="list-unstyled mt-3 mb-4">
					<li>{{$user->phonenumber}}</li>
					<li>{{$user->street}}</li>
					<li>{{$user->zipcode}}</li>
					<li>{{$user->city}}</li>
					<li>{{$user->country}}</li>
				</ul>
			</div>
			<div class="card-footer" id="address_footer">
				<button type="button" id="edit_address"
					class="btn btn-lg btn-block btn-primary">{{__('lang.check-edit')}}</button>
			</div>
		{{--</div>--}}

		<div id="edit_address_form">
			<form method="post" action="{{action('UserController@updateprofile', ['id' => $user->id])}}">
			@csrf
			@method("PUT")
			<div class="card-body">
				<h4 class="card-title pricing-card-title">{{__('lang.edit-address')}}</h4>
					<div class="form-group">
						<label for="phonenumber">{{__('lang.phonenumber')}}</label> <input type="text"
							class="form-control" name="phonenumber"
							value="{{old('phonenumber', $user->phonenumber)}}" />
					</div>
					<div class="form-group">
						<label for="street">{{__('lang.street-number-apartment')}}</label> <input type="text"
							class="form-control" name="street"
							value="{{old('street', $user->street)}}" />
					</div>
					<div class="form-group">
						<label for="zipcode">{{__('lang.post-code')}}</label> <input type="text"
							class="form-control" name="zipcode"
							value="{{old('zipcode', $user->zipcode)}}" />
					</div>
					<div class="form-group">
						<label for="city">{{__('lang.town-city')}}</label> <input type="text"
							class="form-control" name="city"
							value="{{old('city', $user->city)}}" />
					</div>
					<div class="form-group">
						<label for="country">{{__('lang.country')}}</label> 
						<select class="form-control" name="country" id="country">
              				<option value="">---{{__('lang.select')}}---</option>
                  		@foreach(config('countries'.LaravelLocalization::getCurrentLocale()) as $key=>$value)
							<option value="{{$value['name']}}" {{$value['name'] === old('country', $user->country)?'selected':''}}>{{$value['name']}}</option>
  				  		@endforeach
				  		</select>
						{{--<input type="text"
							class="form-control" name="country"
							value="{{old('country', $user->country)}}" />--}}
					</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">{{__('lang.update')}}</button>
				<a class="btn btn-secondary" id="edit_address_cancel" href="#"
					role="button">{{__('lang.cancel')}}</a>
			</div>
			</form>
		</div>

	</div>




	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">{{__('lang.my-orders')}}</h4>
		</div>
		<div class="card-body">
		@if(is_null($latest_order))
			<h3 class="card-title pricing-card-title">
				{{__('lang.no-orders')}}
			</h3>
		@else
			<h3 class="card-title pricing-card-title">
				{{__('lang.latest')}}
			</h3>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.order-date')}}</li>
				<li class="list-inline-item">{{Carbon\Carbon::parse($latest_order->created_at)->timezone('Europe/Stockholm')->toDateString()/*$latest_order->created_at->toDateString()*/}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.status')}}</li>
				<li class="list-inline-item">{{$latest_order->status}}</li>
			</ul>
		@endif
		</div>
		<div class="card-footer">
			<a class="btn btn-lg btn-block btn-primary" href="{{url('myorders')}}" role="button">{{__('lang.view-all')}}</a>
    	</div>
	</div>
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">{{__('lang.test-results')}}</h4>
		</div>
		<div class="card-body">
		@if(is_null($latest_result))
			<h3 class="card-title pricing-card-title">
				{{__('lang.not-ready-yet')}}
			</h3>
		@else
			<h3 class="card-title pricing-card-title">
				Senaste
			</h3>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.result')}}</li>
				<li class="list-inline-item">{{$latest_result->final_reporting_result}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.reporting-date')}}</li>
				<li class="list-inline-item">{{$latest_result->reporting_date}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.order-date')}}</li>
				<li class="list-inline-item">{{Carbon\Carbon::parse($latest_result->kit->order->created_at)->timezone('Europe/Stockholm')->toDateString()}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.sample-registered-date')}}</li>
				<li class="list-inline-item">{{$latest_result->sample_registered_date}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.result-message')}}</li>
				<li class="list-inline-item">{!! config("constants.messages.RESULT_MESSAGE.$latest_result->final_reporting_result") !!}</li>
			</ul>
		@endif	
		</div>
		<div class="card-footer">
			<a class="btn btn-lg btn-block btn-primary" href="{{url('myresults')}}" role="button">{{__('lang.view-all')}}</a>
  		</div>
	</div>
</div>








<script type="text/javascript">

$(document).ready(function(){
	$('#edit_address_form').hide();

	$('#edit_address').click(function(){
		$('#address').hide(500);
		$('#address_footer').hide(500);
		$('#edit_address_form').show(500);
  	});

	$('#edit_address_cancel').click(function(){
		$('#edit_address_form').hide(500);
		$('#address').show(500);
		$('#address_footer').show(500);
  	});

	

	
});

</script>
</x-riscc-layout>
