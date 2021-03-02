@extends('admin.dashboard')



@section('content')
<div class="card">
<div class="row">
 	<div class="col-sm-8 offset-sm-2">
    	<h3 class="display-5">Edit Sample for order id {{$sample->kit->order->id}}</h3>
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
    		
        	<div class="card-body edit-kit">
        	<form method="post" action="{{action('SampleController@update', ['id' => $sample->id])}}">
            	@csrf
            	@method("PUT")
                <div class="form-group">    
                  <label for="sample_id" class="required">Sample ID</label>
                  <input type="text" class="form-control" name="sample_id" value="{{old('sample_id', $sample->sample_id)}}" required/>
                </div>
                
                <div class="form-group">    
                  <label for="lab_id">Lab ID</label>
                  <input type="text" class="form-control" name="lab_id" value="{{old('lab_id', $sample->lab_id)}}" />
                </div>
                
                <div class="form-group form-group.required">
                  <label for="sample_registered_date" class="required">Sample Registered Date</label>
                  <input class="datepicker form-control" name="sample_registered_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('sample_registered_date', $sample->sample_registered_date)}}" required>
                  <small id="sample_registered_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="cobas_result">Cobas Result</label>
                  <select class="form-control" name="cobas_result" id="cobas_result">
              		<option value="">---Select---</option>
                  @foreach(config('constants.result.COBAS') as $key=>$value)
					<option value="{{$value}}" {{$value === old('cobas_result', $sample->cobas_result)?'selected':''}}>{{$value}}</option>
  				  @endforeach
				  </select>
                  {{--<input type="text" class="form-control" name="cobas_result" value="{{old('cobas_result', $sample->cobas_result)}}"/>--}}
                </div>
                
                <div class="form-group form-group.required">
                  <label for="cobas_analysis_date">Cobas Analysis Date</label>
                  <input class="datepicker form-control" name="cobas_analysis_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('cobas_analysis_date', $sample->cobas_analysis_date)}}">
                  <small id="cobas_analysis_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="luminex_result">Luminex Result</label>
                  <select class="form-control" name="luminex_result" id="luminex_result">
              		<option value="">---Select---</option>
                  @foreach(config('constants.result.LUMINEX') as $key=>$value)
					<option value="{{$value}}" {{$value === old('luminex_result', $sample->luminex_result)?'selected':''}}>{{$value}}</option>
  				  @endforeach
				  </select>
                  {{--<input type="text" class="form-control" name="luminex_result" value="{{old('luminex_result', $sample->luminex_result)}}"/>--}}
                </div>
                
                <div class="form-group form-group.required">
                  <label for="luminex_analysis_date">Luminex Analysis Date</label>
                  <input class="datepicker form-control" name="luminex_analysis_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('luminex_analysis_date', $sample->luminex_analysis_date)}}">
                  <small id="luminex_analysis_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="rtpcr_result">RT PCR Result</label>
                  <select class="form-control" name="rtpcr_result" id="rtpcr_result">
              		<option value="">---Select---</option>
                  @foreach(config('constants.result.RTPCR') as $key=>$value)
					<option value="{{$value}}" {{$value === old('rtpcr_result', $sample->rtpcr_result)?'selected':''}}>{{$value}}</option>
  				  @endforeach
				  </select>
                  {{--<input type="text" class="form-control" name="rtpcr_result" value="{{old('rtpcr_result', $sample->rtpcr_result)}}"/>--}}
                </div>
                
                <div class="form-group form-group.required">
                  <label for="rtpcr_analysis_date">RT PCR Analysis Date</label>
                  <input class="datepicker form-control" name="rtpcr_analysis_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('rtpcr_analysis_date', $sample->rtpcr_analysis_date)}}">
                  <small id="rtpcr_analysis_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="final_reporting_result">Final Reporting Result</label>
                  <select class="form-control" name="final_reporting_result" id="final_reporting_result">
              		<option value="">---Select---</option>
                  @foreach(config('constants.result.FINAL_REPORTING') as $key=>$value)
					<option value="{{$value}}" {{$value === old('final_reporting_result', $sample->final_reporting_result)?'selected':''}}>{{$value}}</option>
  				  @endforeach
				  </select>
                  {{--<input type="text" class="form-control" name="final_reporting_result" value="{{old('final_reporting_result', $sample->final_reporting_result)}}"/>--}}
                </div>
                
                <div class="form-group form-group.required">
                  <label for="reporting_date">Reporting Date</label>
                  <input class="datepicker form-control" name="reporting_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('reporting_date', $sample->reporting_date)}}">
                  <small id="reporting_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="reported_via">Reported Via</label>
                  <input type="text" class="form-control" name="reported_via" value="{{old('reported_via', $sample->reported_via)}}"/>
                </div>
                
            	<button type="submit" class="btn btn-primary">Edit Sample</button>
            	<a class="btn btn-secondary" href="{{url('/admin/samples')}}" role="button">Back</a>
            	
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