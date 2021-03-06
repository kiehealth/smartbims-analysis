@extends('admin.dashboard')

@section('dashboard_title')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('lang.Generate Report')}}</h1>
</div>
<div class="card d-flex pt-3 pb-2 mb-3">
	<form method="post" class="form-inline" action="{{action('SearchController@search')}}" id="searchForm">
		@csrf
		<div class="row ml-3">
		
		<div class="col">
		<select class="custom-select my-1 mr-sm-2" name="model" id="model">
			<option value="" selected>{{__('lang.select')}}...</option>
			<option value="User">Users</option>
		</select>
		</div>

		<div class="col">
			<label for="ssn" class="sr-only">SSN</label>
            <input type="text" class="form-control my-1 mr-sm-2" name="ssn" value="{{old('ssn')}}" placeholder="{{__('lang.ssn')}}"/>
   		</div>
		
		<div class="col">
		<select class="custom-select my-1 mr-sm-2" name="filter_criteria" id="filter_criteria">
			<option value="" selected>{{__('lang.select')}}...</option>
			<option value="orders">{{__('lang.Orders')}}</option>
			<option value="unprocessed_orders">{{__('lang.Unprocessed Orders')}}</option>
			<option value="without_orders">{{__('lang.Without Orders')}}</option>
			<option value="kits">{{__('lang.Kits')}}</option>
			<option value="kits_dispatched">{{__('lang.Kits Dispatched')}}</option>
			<option value="samples_received">{{__('lang.Kits/Samples Received')}}</option>
			<option value="samples">{{__('lang.Samples')}}</option>
			<option value="results_reported">{{__('lang.Results Reported')}}</option>
		</select>
		</div>
		
		<div class="col">
            <label for="from_date" class="sr-only">From Date</label>
            <input class="datepicker form-control my-1 mr-sm-2" name="from_date" data-date-format="yyyy-mm-dd" 
            value="{{old('from_date')}}" placeholder="{{__('lang.From Date')}}">
        </div>
        
        <div class="col">
            <label for="to_date" class="sr-only">To Date</label>
            <input class="datepicker form-control my-1 mr-sm-2" name="to_date" data-date-format="yyyy-mm-dd" 
            value="{{old('to_date')}}" placeholder="{{__('lang.To Date')}}">
        </div>
		
		</div>
		<div class="row ml-3">
		<div class="col">
			<button type="submit" class="btn btn-primary my-1">{{__('lang.search')}}</button>
		</div>
		</div>
	</form>
	
</div>

@endsection



@section('content')
<table id="results_table" class="table table-striped table-bordered" width="100%">
</table>
@endsection


@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
    	$('input[name=ssn]').hide();
    	$('#filter_criteria').hide();
    	$('input[name=from_date]').hide();
		$('input[name=to_date]').hide();

    	var showDatesCondition = ["orders", "unprocessed_orders", "kits", "kits_dispatched", "samples_received", "samples", "results_reported"];
		
    	$('#model').on('change', function() {
    		if(this.value=="User"){
    			$('input[name=ssn]').show();
    			$('#filter_criteria').show();
    			if($.inArray($('select[name=filter_criteria]').val(), showDatesCondition) !== -1){
    				$('input[name=from_date]').show();
        			$('input[name=to_date]').show();
        		}
    			
        	}
    		else{
    			$('input[name=ssn]').hide();
    			$('#filter_criteria').hide();
    			$('input[name=from_date]').hide();
    			$('input[name=to_date]').hide();
        	}
    	});



    	$('#filter_criteria').on('change', function() {
    		if ($.inArray(this.value, showDatesCondition) !== -1) {
    			$('input[name=from_date]').show();
    			$('input[name=to_date]').show();
    		}
    		else{
    			$('input[name=from_date]').hide();
    			$('input[name=to_date]').hide();
            }
        	/*
    		if(this.value=="without_orders"){
    			$('input[name=from_date]').hide();
    			$('input[name=to_date]').hide();
        	}
    		if(this.value=="orders"){
    			$('input[name=from_date]').show();
    			$('input[name=to_date]').show();
        	}
    		if(this.value=="unprocessed_orders"){
    			$('input[name=from_date]').show();
    			$('input[name=to_date]').show();
        	}
    		if(this.value=="unprocessed_orders"){
    			$('input[name=from_date]').show();
    			$('input[name=to_date]').show();
        	}*/
    	});
        
    	$('#searchForm').submit(function(event){
    		event.preventDefault();
    		
        	
        	var formData = {
                	'_token'			: $('input[name=_token]').val(),
                    'model'             : $('select[name=model]').val(),
                    'ssn'				: $('input[name=ssn]').val(),
                    'filter_criteria'   : $('select[name=filter_criteria]').val(),
                    'from_date'         : $('input[name=from_date]').val(),
                    'to_date'    		: $('input[name=to_date]').val()
            };

             
        	
        	$.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : "{{action('SearchController@search')}}", // the url where we want to POST
                data        : formData, // our data object
                success:function(response){
                    if(typeof response == 'object' && !(response.data === 'undefined' || response.data.length == 0)){
						var exportTitle = response.query_title;
    					var columns = [];
    					var columnNames = Object.keys(response.data[0]);
    					let i = 0;
    					$.each(columnNames, function( key, value ) {
    						columns.push({data : columnNames[key], title: response.columns[i]})
    						i++;
    					});

    					if ( $.fn.dataTable.isDataTable( '#results_table' ) ) {
    					    $('#results_table').DataTable().destroy();
    					    $('#results_table').empty();
    					}
    					$('#results_table').DataTable({
    						data: response.data,
    						columns: columns,
    						dom: 'Blfrtip',
    						"scrollX": true,
    						"language": {
    			                "url": "{{asset('lang/'.LaravelLocalization::getCurrentLocale().'/datatables.json')}}"
    			            },
    			            buttons: [
    			                'colvis', 
    			                {
    			                	extend: 'copy',
    			                	title: exportTitle,
    			                },
    			                {
    			                	extend: 'csv',
    			                	title: exportTitle,
    			                },
    		                 	{
    		                 		extend: 'excel',
    		                 		title: exportTitle,
    		                 		customize: function ( xlsx ) {
    		                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
    		                            $('row:first c', sheet).attr( 's', '2' ); // first row is bold
    		                        }
    		                  	},
    		                  	{
    		                  		extend: 'pdf',
    		                  		title: exportTitle,
    		                   	},
    		                   	{
    		                   		extend: 'print',
    		                   		title: exportTitle,
    		                    }
    			            ],
    			            

                        });
    					
                    }
                    else{
                        if ( $.fn.dataTable.isDataTable( '#results_table' ) ) {
    					    $('#results_table').DataTable().destroy();
    					    $('#results_table').empty();
    					}
                    }
                }
            

            });
        });
        	
        
    });

    $('.datepicker').datepicker({
    	dateFormat: "yy-mm-dd",
    	showWeek: true,
    	firstDay: 1
    });

</script>
@endsection

