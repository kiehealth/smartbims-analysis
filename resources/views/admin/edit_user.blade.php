@extends('admin.dashboard')



@section('content')
<div class="card">
<div class="row">
 	<div class="col-sm-8 offset-sm-2">
    	<h3 class="display-5">Update User</h3>
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
        	<div class="alert alert-danger">{{ session('error') }}</div>
        	@endif
        	<div class="card-body edit-user">
        	<form method="post" action="{{action('UserController@update', ['id' => $user->id])}}">
            	@csrf
            	@method("PUT")
                <div class="form-group">    
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" name="first_name" value="{{old('first_name', $user->first_name)}}"/>
                </div>
                
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" name="last_name" value="{{old('last_name', $user->last_name)}}"/>
                </div>
                
                <div class="form-group form-group.required">
                  <label for="pnr" class="required">PNR</label>
                  <input type="text" class="form-control" name="pnr" value="{{old('pnr', $user->pnr)}}" required/>
                  <small id="pnrHelp" class="form-text text-muted">ÅÅÅÅMMDDNNNN</small>
                </div>
                <div class="form-group">
                  <label for="phonenumber">Phonenumber</label>
                  <input type="text" class="form-control" name="phonenumber" value="{{old('phonenumber', $user->phonenumber)}}"/>
                </div>
                <div class="form-group">
                <label for="roles">Roles</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="user_role" value="{{Config::get('constants.roles.USER_ROLE')}}"
                  {{old('user_role') ? 'checked' : (Str::contains($user->roles, 'USER_ROLE')?"checked":"")}}>
                  <label class="form-check-label" for="user_role">USER_ROLE</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="admin_role" value="{{Config::get('constants.roles.ADMIN_ROLE')}}"
                  {{old('admin_role') ? 'checked' : (Str::contains($user->roles, 'ADMIN_ROLE')?"checked":"")}}>
                  <label class="form-check-label" for="admin_role">ADMIN_ROLE</label>
                </div>
                </div>
                <div class="form-group">
                  <label for="street">Street</label>
                  <input type="text" class="form-control" name="street" value="{{old('street', $user->street)}}"/>
                </div>
                <div class="form-group">
                  <label for="zipcode">Zipcode</label>
                  <input type="text" class="form-control" name="zipcode" value="{{old('zipcode', $user->zipcode)}}"/>
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" name="city" value="{{old('city', $user->city)}}"/>
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <select class="form-control" name="country" id="country">
              		<option value="">---Select---</option>
                  @foreach(config('countries') as $key=>$value)
					<option value="{{$value['name']}}" {{$value['name'] === old('country', $user->country)?'selected':''}}>{{$value['name']}}</option>
  				  @endforeach
				  </select>
                  {{--<input type="text" class="form-control" name="country" value="{{old('country', $user->country)}}"/>--}}
                </div>
                <div class="form-group">
                <label for="consent">Consent to Study</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="consent_yes" name="consent" value="1"
                  {{"1"==old('consent_yes', $user->consent) ? "checked" : ""/*old('consent') ? 'checked' : (($user->consent=="1")?"checked":"")*/}}>
                  <label class="form-check-label" for="consent_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="consent_no" name="consent" value="0"
                  {{"0"==old('consent_no', $user->consent) ? "checked" : ""/*old('consent') ? 'checked' : (($user->consent=="0")?"checked":"")*/}}>
                  <label class="form-check-label" for="consent_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="consent_no_answer" name="consent" value=""
                  {{old('consent_no_answer', is_null($user->consent)) ? "checked" : ""/*old('consent') ? 'checked' : (is_null($user->consent)?"checked":"")*/}}>
                  <label class="form-check-label" for="consent_no_answer">No Answer</label>
                </div>
                </div>
                
            	<button type="submit" class="btn btn-primary">Update User</button>
            	<a class="btn btn-secondary" href="{{url('/admin/users')}}" role="button">Cancel</a>
            </form>
            </div>
      	</div>
	</div>
</div>
</div>
@endsection