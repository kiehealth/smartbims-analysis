<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('head')
</head>

<body>

	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
       @include('header')
    </div>
    
    @yield('research_description')
    
    <div class="container">
    
    @yield('content')
    @yield('scripts')
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
    	@include('footer')
    </footer>
    </div>
    
</body>

<script src="{{ asset('js/main.js') }}"></script>

<script type="text/javascript">
</script>
</html>