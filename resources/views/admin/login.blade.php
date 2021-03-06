<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Admin Login</title>

	<link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
  </head>
  <body class="text-center">
  <div class="form-signin">
  <img class="mb-4" src="{{ asset('img/KI_logo.png') }}" alt="" width="72" height="72">
  <img class="mb-4" src="{{ asset('img/HPV_logo.png') }}" alt="" width="72" height="72">
  <x-application-logo class="mb-3" width="72" height="72"/>
  
  {{-- <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div> --}}
  
  @if(isset($msg))
  <div class="alert alert-danger">{{ $msg }}</div>
  @endif
  
  @if(session('msg'))
  <div class="alert alert-danger">{{ session('msg') }}</div>
  @endif
  
  <a class="btn btn-lg btn-primary btn-block" href="{{ route('admin.login', ['type' => 'admin']) }}" title="Log in" role="button">{{ __('lang.Login') }}</a>
  <p class="mt-5 mb-3 text-muted">&copy; 2021, Admin Panel</p>
</div>
</body>
</html>
