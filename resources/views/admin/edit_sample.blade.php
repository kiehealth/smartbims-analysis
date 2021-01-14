@extends('admin.dashboard')



@section('content')
<div class="card">
<div class="row">
 	<div class="col-sm-8 offset-sm-2">
    	<h3 class="display-5">Edit Sample</h3>
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
                  <label for="sample_id">Sample ID</label>
                  <input type="text" class="form-control" name="sample_id" value="{{old('sample_id', $sample->sample_id)}}" required/>
                </div>
                
                <div class="form-group">    
                  <label for="lab_id">Lab ID</label>
                  <input type="text" class="form-control" name="lab_id" value="{{old('lab_id', $sample->lab_id)}}" />
                </div>
                
                <div class="form-group form-group.required">
                  <label for="sample_registered_date">Sample Registered Date</label>
                  <input class="datepicker form-control" name="sample_registered_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('sample_registered_date', $sample->sample_registered_date)}}">
                  <small id="sample_registered_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="cobas_result">Cobas Result</label>
                  <input type="text" class="form-control" name="cobas_result" value="{{old('cobas_result', $sample->cobas_result)}}"/>
                </div>
                
                <div class="form-group">
                  <label for="genotyping_result">Genotyping Result</label>
                  <input type="text" class="form-control" name="genotyping_result" value="{{old('genotyping_result', $sample->genotyping_result)}}"/>
                </div>
                
                <div class="form-group">
                  <label for="luminex_result">Luminex Result</label>
                  <input type="text" class="form-control" name="luminex_result" value="{{old('luminex_result', $sample->luminex_result)}}"/>
                </div>
                
                <div class="form-group form-group.required">
                  <label for="analysis_date">Analysis Date</label>
                  <input class="datepicker form-control" name="analysis_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('analysis_date', $sample->analysis_date)}}">
                  <small id="analysis_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="rtpcr_result">RT PCR Result</label>
                  <input type="text" class="form-control" name="rtpcr_result" value="{{old('rtpcr_result', $sample->rtpcr_result)}}"/>
                </div>
                
                <div class="form-group form-group.required">
                  <label for="rtpcr_analysis_date">RT PCR Analysis Date</label>
                  <input class="datepicker form-control" name="rtpcr_analysis_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('rtpcr_analysis_date', $sample->rtpcr_analysis_date)}}">
                  <small id="rtpcr_analysis_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
                <div class="form-group">
                  <label for="reported_via">Reported Via</label>
                  <input type="text" class="form-control" name="reported_via" value="{{old('reported_via', $sample->reported_via)}}"/>
                </div>
                
                <div class="form-group form-group.required">
                  <label for="reporting_date">Reporting Date</label>
                  <input class="datepicker form-control" name="reporting_date" data-date-format="yyyy-mm-dd" 
                  value="{{old('reporting_date', $sample->reporting_date)}}">
                  <small id="reporting_dateHelp" class="form-text text-muted">yyyy-mm-dd</small>
                </div>
                
            	<button type="submit" class="btn btn-primary">Edit Kit</button>
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