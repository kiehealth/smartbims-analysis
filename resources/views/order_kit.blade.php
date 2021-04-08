<x-riscc-layout>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto research">
	
	@if(session()->has('order_created'))
    <div class="alert alert-success text-justify">
      {!! session('order_created') !!}  
    </div>
	@endif
	
	@if(!session()->has('order_created'))
	<p class="lead">{{__('lang.click-button-to-order')}}</p>
	<form class="text-center" action="{{action('OrderController@orderKit', ['user_id' => session('user_id')])}}" method="post">
        @csrf
        <input type="hidden" name="user_id" value = "{{ Auth::user()->id }}" >
        <button type="submit" class="btn btn-primary btn-lg">{{__('lang.Order')}}</button>
    </form>
    @endif
</div>
</x-riscc-layout>