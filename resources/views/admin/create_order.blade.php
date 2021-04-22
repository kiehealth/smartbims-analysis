@extends('admin.dashboard')


@section('content')
<div class="card">
<div class="row">
 	<div class="col-sm-8 offset-sm-2">
    	<h3 class="display-5">{{__('lang.Create Order')}}</h3>
      	<div>
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br />
            @endif
           
    		@if (session('error'))
        	<div class="alert alert-danger">{!! session('error') !!}</div>
        	@endif
        	<div class="card-body create-order">
        	<form method="post" action="{{action('OrderController@store', ['type' => 'admin'])}}">
            	@csrf
                <div class="form-group form-group.required">
                  <label for="ssn" class="required">{{__('lang.ssn')}}</label>
                  <input type="text" class="form-control" name="ssn" value="{{old('ssn')}}" required/>
                  {{--<small id="pnrHelp" class="form-text text-muted">ÅÅÅÅMMDDNNNN</small>--}}
                </div>
                <button type="submit" class="btn btn-primary">{{__('lang.Create Order')}}</button>
            	<a class="btn btn-secondary" href="{{url('/admin/orders')}}" role="button">{{__('lang.Cancel')}}</a>
            </form>
            </div>
      	</div>
	</div>
</div>
</div>
@endsection