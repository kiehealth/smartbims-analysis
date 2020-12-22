@extends('home')

@section('content')

<div class="card-deck mb-3 text-center">
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Mina Uppgifter</h4>
		</div>
		<div class="card-body">
			<h1 class="card-title pricing-card-title">
				Adress {{--<small class="text-muted">/ mo</small>--}}
			</h1>
			<ul class="list-unstyled mt-3 mb-4">
				<li>{{$user->street}}</li>
				<li>{{$user->zipcode}}</li>
				<li>{{$user->city}}</li>
				<li>{{$user->country}}</li>
			</ul>
			<button type="button"
				class="btn btn-lg btn-block btn-outline-primary">Kontrollera/Ändra</button>
		</div>
	</div>
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Mina Beställningar</h4>
		</div>
		<div class="card-body">
			<h1 class="card-title pricing-card-title">
				Senaste
			</h1>
			<ul class="list-unstyled mt-3 mb-4">
				<li>20 users included</li>
				<li>10 GB of storage</li>
				<li>Priority email support</li>
				<li>Help center access</li>
			</ul>
			<button type="button" class="btn btn-lg btn-block btn-primary">Se alla</button>
		</div>
	</div>
	<div class="card mb-4 shadow-sm">
		<div class="card-header">
			<h4 class="my-0 font-weight-normal">Provsvar</h4>
		</div>
		<div class="card-body">
			<h1 class="card-title pricing-card-title">
				$29 <small class="text-muted">/ mo</small>
			</h1>
			<ul class="list-unstyled mt-3 mb-4">
				<li>30 users included</li>
				<li>15 GB of storage</li>
				<li>Phone and email support</li>
				<li>Help center access</li>
			</ul>
			<button type="button" class="btn btn-lg btn-block btn-primary">Se alla</button>
		</div>
	</div>
</div>


@endsection