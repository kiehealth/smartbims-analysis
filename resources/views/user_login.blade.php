@extends('home')


@section('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto research">
	<p class="lead text-center">Vänligen logga in med Mobilt BankID för att kontrollera dina uppgifter, beställningar, samt se
		dina provsvar</p>
	<p class="lead text-center">
	<a class="btn btn-primary consent-btn" href="{{action('BankIDController@bankidlogin', ['type' => 'user'])}}">Mobilt BankID</a>
	</p>
</div>



@endsection