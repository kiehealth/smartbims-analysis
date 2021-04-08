<x-riscc-layout>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto research">
	
	@if(session()->has('unsubscribed'))
    <div class="alert alert-success text-justify">
      {!! session('unsubscribed') !!}  
    </div>
	@endif
	
	@if(!session()->has('unsubscribed'))
	<p class="lead">{{__('lang.click-button-to-withdraw-consent')}}</p>
	<p class="lead">{{__('lang.regret-withdraw-consent')}}</p>
	<form class="text-center" action="{{action('UserController@unsubscribe', ['user_id' => session('user_id')])}}" method="post">
        @csrf
        <input type="hidden" name="user_id" value = "{{ session('user_id') }}" >
        <button type="submit" class="btn btn-primary btn-lg">{{__('lang.end-participation')}}</button>
    </form>
    @endif
</div>
</x-riscc-layout>
