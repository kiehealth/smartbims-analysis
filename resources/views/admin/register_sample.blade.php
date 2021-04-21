@extends('admin.dashboard')



@section('content')
<div class="card">
<div class="row">
 	<div class="col-sm-8 offset-sm-2">
    	<h3 class="display-5">{{__('lang.register-sample-for-order-x-kit-x', ['order_id' => $kit->order->id, 'kit_id' => $kit->id])}}</h3>
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
    		
        	<div class="card-body register-sample">
        	<form method="post" action="{{action('SampleController@register', ['id' => $kit->id])}}">
            	@csrf
                <div class="form-group">    
                  <label for="sample_id" class="required">Sample ID</label>
                  <input type="text" class="form-control" name="sample_id" value="{{old('sample_id', $kit->sample_id)}}" required/>
                </div>
                
                <div class="form-group form-group.required">
                  <label for="sample_registered_date" class="required">Sample Registered Date</label>
                  <input class="datepicker form-control" name="sample_registered_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('sample_registered_date', !empty($kit->sample_received_date)?$kit->sample_received_date:Carbon\Carbon::now()->toDateString())}}"
                  required>
                  <small id="sample_registered_dateHelp" class="form-text text-muted">{{__('lang.yyyy-mm-dd')}}</small>
                </div>
                
                
            	<button type="submit" class="btn btn-primary">{{__('lang.Register Sample')}}</button>
            	<a class="btn btn-secondary" href="{{url('/admin/kits')}}" role="button">{{__('lang.Cancel')}}</a>
            </form>
            </div>
      	</div>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('.datepicker').datepicker({
	dateFormat: "yy-mm-dd",
	showWeek: true,
	firstDay: 1
});
</script>
@endsection