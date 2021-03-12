@extends('admin.dashboard')

@section('dashboard_title')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Generate Report</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          	<a href='{{action('UserController@create')}}'>
          		<button type="button" class="btn btn-sm btn-outline-secondary">Add User</button>
          	</a>
            <a href='{{action('UserController@import')}}'>
            	<button type="button" class="btn btn-sm btn-outline-secondary">Import Users</button>
            </a>
          </div>
        </div>
</div>
@endsection



@section('content')

@endsection

