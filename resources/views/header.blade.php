
<a href="{{ url('/') }}">
	<img src="{{ asset('img/KI_logo.png') }}" alt="Karolinska HPV Self Sampling"
	title="Karolinska HPV Self Sampling" width="62" height="62">
</a>
<a href="{{ url('/') }}" class="mr-md-auto">
	<x-application-logo class="w-20 h-20 fill-current text-gray-500" />
</a>
<h5 class="my-0 mr-md-auto font-weight-normal site-title">International Human
	Papillomavirus Reference Center</h5>

@if (Route::has('login'))

@auth
<nav x-data="{ open: false }" class="bg-white border-gray-100 ml-md-auto">
	<!-- Settings Dropdown -->
	<div class="hidden sm:flex sm:items-center sm:ml-6">
		<x-dropdown align="right" width="48"> 
		<x-slot name="trigger">
		<button
			class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out mr-1">
			<div>{{ Auth::user()->name }}</div>

			<div class="ml-1">
				<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
						d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
						clip-rule="evenodd" />
                </svg>
			</div>
		</button>
		</x-slot> 
		<x-slot name="content">
			@if(stristr(Auth::user()->roles, config('constants.roles.ADMIN_ROLE')) !== FALSE)
			<x-dropdown-link :href="url('admin')">
    			{{ __('lang.admin') }} 
    		</x-dropdown-link>
    		@endif
    		<x-dropdown-link :href="url('myprofile')">
    			{{ __('lang.profile') }} 
    		</x-dropdown-link>
    		<x-dropdown-link :href="url('change-password')">
    			{{ __('lang.change-password') }} 
    		</x-dropdown-link>
    		<!-- Authentication -->
    		<form method="POST" action="{{ route('logout') }}">
    			@csrf
    
    			<x-dropdown-link :href="route('logout')"
    				onclick="event.preventDefault();
                                                    this.closest('form').submit();">
    			{{ __('lang.Log out') }} 
    			</x-dropdown-link>
    		</form>
		</x-slot> 
		</x-dropdown>
		
		<x-dropdown align="right" width="48"> 
        <x-slot name="trigger">
        <button
        	class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out ml-1">
        	<div>{{ LaravelLocalization::getCurrentLocale() }}</div>
        
        	<div class="ml-1">
        		<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
        			viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
        				d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        				clip-rule="evenodd" />
                </svg>
        	</div>
        </button>
        </x-slot> 
        <x-slot name="content"> <!-- Language Selector -->
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        	<x-dropdown-link href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
        		hreflang="{{ $localeCode }}">
        	{{ $properties['native'] }} 
        	</x-dropdown-link>
        @endforeach
        </x-slot> 
    	</x-dropdown>
	</div>
	
	<!-- Hamburger -->
    <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <!-- Responsive Language Selector -->
    <div class="-mr-2 flex items-center sm:hidden">
        <x-dropdown align="right" width="28"> 
        	<x-slot name="trigger">
        	<button
        		class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out ml-1">
        		<div>{{ LaravelLocalization::getCurrentLocale() }}</div>
        
        		<div class="ml-1">
        			<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
        				viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
        					d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        					clip-rule="evenodd" />
                    </svg>
        		</div>
        	</button>
        	</x-slot> 
        	<x-slot name="content"> <!-- Language Selector -->
        	@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        		<x-dropdown-link href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
        			hreflang="{{ $localeCode }}">
        		{{ $properties['native'] }} 
        		</x-dropdown-link>
        	@endforeach
        	</x-slot> 
    	</x-dropdown>
    </div>
    
    
    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200 hidden sm:hidden" :class="{'block': open, 'hidden': ! open}">
        <div class="flex items-center px-4">
            <div class="flex-shrink-0">
                <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>

            <div class="ml-3">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>
		<div class="mt-3 space-y-1">
			@if(stristr(Auth::user()->roles, config('constants.roles.ADMIN_ROLE')) !== FALSE)
			<x-responsive-nav-link :href="url('admin')">
    			{{ __('lang.admin') }} 
    		</x-responsive-nav-link>
    		@endif
    		<x-responsive-nav-link :href="url('myprofile')">
    			{{ __('lang.profile') }} 
    		</x-responsive-nav-link>
    		<x-responsive-nav-link :href="url('change-password')">
    			{{ __('lang.change-password') }} 
    		</x-responsive-nav-link>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('lang.Log out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>


@else
<a class="btn btn-outline-primary ml-md-auto" href="{{ route('login') }}" title="Log in">{{ __('lang.Login') }}</a>
<nav class="my-2 my-md-0 mr-md-3 links">
	<a class="p-2 {{ (request()->is('*profile')) ? 'active' : '' }}" href="{{url('/register')}}" title="Register">{{ __('lang.Register') }}</a>
</nav>


<!-- Language Selector -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48"> 
        <x-slot name="trigger">
        <button
        	class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out ml-1">
        	<div>{{ LaravelLocalization::getCurrentLocale() }}</div>
        
        	<div class="ml-1">
        		<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
        			viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
        				d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        				clip-rule="evenodd" />
                </svg>
        	</div>
        </button>
        </x-slot> 
        <x-slot name="content"> <!-- Language Selector -->
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        	<x-dropdown-link href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
        		hreflang="{{ $localeCode }}">
        	{{ $properties['native'] }} 
        	</x-dropdown-link>
        @endforeach
        </x-slot> 
    </x-dropdown>
</div>

<!-- Responsive Language Selector -->
<div class="-mr-2 flex items-center sm:hidden">
	<x-dropdown align="right" width="28"> 
	<x-slot name="trigger">
	<button
		class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out ml-1">
		<div>{{ LaravelLocalization::getCurrentLocale() }}</div>

		<div class="ml-1">
			<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 20 20">
                <path fill-rule="evenodd"
					d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
					clip-rule="evenodd" />
            </svg>
		</div>
	</button>
	</x-slot> 
	<x-slot name="content"> <!-- Language Selector -->
	@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
		<x-dropdown-link href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
			hreflang="{{ $localeCode }}">
		{{ $properties['native'] }} 
		</x-dropdown-link>
	@endforeach
	</x-slot> 
	</x-dropdown>
</div>
</nav>
@endauth
@endif