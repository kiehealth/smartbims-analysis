@extends('admin.dashboard')

@section('dashboard_title')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Generate Report</h1>
</div>
<div class="card d-flex pt-3 pb-2 mb-3">
	<form method="post" class="form-inline" action="{{action('SearchController@search')}}" id="searchForm">
		@csrf
		<div class="row ml-3">
		
		<div class="col">
		<select class="custom-select my-1 mr-sm-2" name="model" id="model">
			<option value="" selected>Select...</option>
			<option value="User">Users</option>
		</select>
		</div>

		<div class="col">
			<label for="pnr" class="sr-only">PNR</label>
            <input type="text" class="form-control my-1 mr-sm-2" name="pnr" value="{{old('pnr')}}" placeholder="ÅÅÅÅMMDDNNNN"/>
   		</div>
		
		<div class="col">
		<select class="custom-select my-1 mr-sm-2" name="filter_criteria" id="filter_criteria">
			<option value="" selected>Select...</option>
			<option value="orders">Orders</option>
			<option value="without_orders">Without Orders</option>
			<option value="kits">Kits</option>
			<option value="kits_dispatched">Kits Dispatched</option>
			<option value="samples_received">Kits/Samples Received</option>
			<option value="samples">Samples</option>
			<option value="results_reported">Results Reported</option>
		</select>
		</div>
		
		<div class="col">
            <label for="from_date" class="sr-only">From Date</label>
            <input class="datepicker form-control my-1 mr-sm-2" name="from_date" data-date-format="yyyy-mm-dd" 
            value="{{old('from_date')}}" placeholder="From">
        </div>
        
        <div class="col">
            <label for="to_date" class="sr-only">To Date</label>
            <input class="datepicker form-control my-1 mr-sm-2" name="to_date" data-date-format="yyyy-mm-dd" 
            value="{{old('to_date')}}" placeholder="To">
        </div>
		
		</div>
		<div class="row ml-3">
		<div class="col">
			<button type="submit" class="btn btn-primary my-1">Search</button>
		</div>
		</div>
	</form>
	
</div>

@endsection



@section('content')
<table id="results_table" class="table table-striped table-bordered">
</table>
@endsection


@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
    	$('input[name=pnr]').hide();
    	$('#filter_criteria').hide();
    	$('input[name=from_date]').hide();
		$('input[name=to_date]').hide();
    	
    	$('#model').on('change', function() {
    		if(this.value=="User"){
    			$('input[name=pnr]').show();
    			$('#filter_criteria').show();
    			$('input[name=from_date]').show();
    			$('input[name=to_date]').show();
        	}
    		else{
    			$('input[name=pnr]').hide();
    			$('#filter_criteria').hide();
    			$('input[name=from_date]').hide();
    			$('input[name=to_date]').hide();
        	}
    	});
        
    	$('#searchForm').submit(function(event){
    		event.preventDefault();
    		
        	
        	var formData = {
                	'_token'			: $('input[name=_token]').val(),
                    'model'             : $('select[name=model]').val(),
                    'pnr'				: $('input[name=pnr]').val(),
                    'filter_criteria'   : $('select[name=filter_criteria]').val(),
                    'from_date'         : $('input[name=from_date]').val(),
                    'to_date'    		: $('input[name=to_date]').val()
            };
        	
        	$.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : "{{action('SearchController@search')}}", // the url where we want to POST
                data        : formData, // our data object
                success:function(response){
                    if(typeof response == 'object'){
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
    			            buttons: [
    			                'colvis', 
    			                {
    			                	extend: 'copy',
    			                	title: 'Query Results Export',
    			                },
    			                {
    			                	extend: 'csv',
    			                	title: 'Query Results Export',
    			                },
    		                 	{
    		                 		extend: 'excel',
    		                 		title: 'Query Results Export',
    		                  	},
    		                  	{
    		                  		extend: 'pdf',
    		                  		title: 'Query Results Export',
    		                   	},
    		                   	{
    		                   		extend: 'print',
    		                   		title: 'Query Results Export',
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

