<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Self-Sampling Admin</a>
  
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="{{action('BankIDController@bankidlogout', ['sessionId' => session('grandidsession')])}}">Sign out</a>
    </li>
  </ul>
  --}}
  
  
  
  <div class="dropdown ml-auto">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::user()->name}}
      </a>
    
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      	<form method="POST" action="{{ route('logout', ['type' => 'admin']) }}">
            @csrf
            <a class="dropdown-item" href="{{route('logout', ['type' => 'admin'])}}" 
            	onclick="event.preventDefault(); 
            	    this.closest('form').submit();">{{__('lang.Log out')}}</a>
        </form>
        <a class="dropdown-item" href="{{url("/")}}">{{ __('lang.to-front') }}</a>
      </div>
  </div>
  
  <div class="dropdown ml-2 mr-2">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLinkLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ LaravelLocalization::getCurrentLocale() }}
      </a>
    
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLinkLanguage">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			<a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" hreflang="{{ $localeCode }}">{{ $properties['native'] }}</a>
      @endforeach
      </div>
  </div>
</nav>