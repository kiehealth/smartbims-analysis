@extends('home')

@section('content')

<div class="card-deck mb-3 text-center profile-card">
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Mina Uppgifter</h4>
		</div>
		@if(session('user_profile_updated'))
			<div class="alert alert-success">{{ session('user_profile_updated') }}</div>
		@endif
		<div id="address">
			<div class="card-body">
				<h3 class="card-title pricing-card-title">
					Adress {{--<small class="text-muted">/ mo</small>--}}
				</h3>
				<ul class="list-unstyled mt-3 mb-4">
					<li>{{$user->phonenumber}}</li>
					<li>{{$user->street}}</li>
					<li>{{$user->zipcode}}</li>
					<li>{{$user->city}}</li>
					<li>{{$user->country}}</li>
				</ul>
			</div>
			<div class="card-footer">
				<button type="button" id="edit_address"
					class="btn btn-lg btn-block btn-primary">Kontrollera/Redigera</button>
			</div>
		</div>

		<div id="edit_address_form">
			<form method="post" action="{{action('UserController@updateprofile', ['id' => $user->id])}}">
			@csrf
			@method("PUT")
			<div class="card-body">
				<h4 class="card-title pricing-card-title">Redigera Adress</h4>
					<div class="form-group">
						<label for="phonenumber">Phonennummer</label> <input type="text"
							class="form-control" name="phonenumber"
							value="{{old('phonenumber', $user->phonenumber)}}" />
					</div>
					<div class="form-group">
						<label for="street">Gata/Gatunummer/Lgh</label> <input type="text"
							class="form-control" name="street"
							value="{{old('street', $user->street)}}" />
					</div>
					<div class="form-group">
						<label for="zipcode">Postnummer</label> <input type="text"
							class="form-control" name="zipcode"
							value="{{old('zipcode', $user->zipcode)}}" />
					</div>
					<div class="form-group">
						<label for="city">Ort</label> <input type="text"
							class="form-control" name="city"
							value="{{old('city', $user->city)}}" />
					</div>
					<div class="form-group">
						<label for="country">Land</label> <input type="text"
							class="form-control" name="country"
							value="{{old('country', $user->country)}}" />
					</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Uppdatera</button>
				<a class="btn btn-secondary" id="edit_address_cancel" href="#"
					role="button">Cancel</a>
			</div>
			</form>
		</div>

	</div>




	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Mina Beställningar</h4>
		</div>
		<div class="card-body">
		@if(is_null($latest_order))
			<h3 class="card-title pricing-card-title">
				Inga Beställningar
			</h3>
		@else
			<h3 class="card-title pricing-card-title">
				Senaste
			</h3>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Beställning Datum</li>
				<li class="list-inline-item">{{$latest_order->created_at->toDateString()}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Status</li>
				<li class="list-inline-item">{{$latest_order->status}}</li>
			</ul>
		@endif
		</div>
		<div class="card-footer">
			<a class="btn btn-lg btn-block btn-primary" href="{{url('myorders')}}" role="button">Se alla</a>
    	</div>
	</div>
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Provsvar</h4>
		</div>
		<div class="card-body">
			<h3 class="card-title pricing-card-title">
				Inte färdigt än
			</h3>
			{{--
			<ul class="list-unstyled mt-3 mb-4">
				<li>30 users included</li>
				<li>15 GB of storage</li>
				<li>Phone and email support</li>
				<li>Help center access</li>
			</ul>
			--}}
		</div>
		<div class="card-footer">
    		<button type="button" class="btn btn-lg btn-block btn-primary">Se alla</button>
  		</div>
	</div>
</div>

@endsection





@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
	$('#edit_address_form').hide();

	$('#edit_address').click(function(){
		$('#address').hide(500);
		$('#edit_address_form').show(500);
  	});

	$('#edit_address_cancel').click(function(){
		$('#edit_address_form').hide(500);
		$('#address').show(500);
  	});

	

	
});

</script>
@endsection