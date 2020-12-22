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
  
  
  
  
  <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{session('userattributes')['name']}}
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="{{action('BankIDController@bankidlogout', ['sessionId' => session('grandidsession'), 'type' => 'admin'])}}">Sign out</a>
  </div>
  </div>
</nav>