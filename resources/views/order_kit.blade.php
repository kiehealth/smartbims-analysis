@extends('home')
{{var_dump(request()->session()->get('userattributes')['personalNumber'])}}

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto research">
	<h1 class="display-4 text-center">Beställa via logga in med Mobilt BankID</h1>
	<p class="lead">Om du loggar in med Mobilt BankID kan du kontrollera dina uppgifter, beställningar, samt se
		dina prov svar.
	</p>
	<p class="lead text-center">
	<a class="btn btn-primary consent-btn" href="{{action('BankIDController@bankidlogin', ['type' => 'user'])}}">Beställa via Mobilt BankID</a>
	</p>
</div>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto research border-top">	
	<h1 class="display-4 text-center">Beställa utan inlognning</h1>
	<p class="lead">Om du inte har Mobilt BankID eller vill beställa utan inloggning 
		kan du vänligen ange ditt personnummer i fältet nedan.
	</p>

    @if(session()->has('order_created'))
    <div class="alert alert-success text-center">
      {{ session('order_created') }}  
    </div>
	@endif
	
    @if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
	<form class="form-inline justify-content-center" action="{{url('orders')}}" method="post">
        @csrf
        <input type="text" name="pnr" class="form-control mb-2 mr-sm-2" id="pnr" 
        value = "{{ old('pnr') }}" placeholder="ÅÅÅÅMMDDNNNN">
        <button type="submit" class="btn btn-primary mb-2">Beställa</button>
    </form>
</div>
@endsection