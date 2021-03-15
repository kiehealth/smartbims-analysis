@extends('admin.dashboard')

@section('dashboard_title')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Generate Report</h1>
</div>
<div class="card d-flex pt-3 pb-2 mb-3">
	<form method="post" class="form-inline" action="{{action('SearchController@search')}}">
		@csrf
		<div class="row ml-3">
		
		<div class="col">
		<select class="custom-select my-1 mr-sm-2" name="model" id="model">
			<option value="" selected>Select...</option>
			<option value="User">Users</option>
			<option value="2">Two</option>
			<option value="3">Three</option>
		</select>
		</div>

		<div class="col">
			<input type="checkbox" class="custom-control-input"
				id="customControlInline"> <label class="custom-control-label"
				for="customControlInline">Remember my preference</label>
		</div>
		
		</div>
		<div class="row">
		<button type="submit" class="btn btn-primary my-1">Filter</button>
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
    	$('form').submit(function(event){
        	event.preventDefault();
        	var formData = {
                	'_token'			: $('input[name=_token]').val(),
                    'model'              : $('select[name=model]').val(),
                    //'email'             : $('input[name=email]').val(),
                    //'superheroAlias'    : $('input[name=superheroAlias]').val()
            };
        	
        	$.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : "{{action('SearchController@search')}}", // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                success:function(response){
					var columns = [];
					var columnNames = Object.keys(response.data[0]);
					let i = 0;
					$.each(columnNames, function( key, value ) {
						
						columns.push({data : columnNames[key], title: response.columns[i]})
						i++;
					});
					/*$.each(response.columns, function(key, value){
						columns.push({title: value})
					});*/
					$('#results_table').DataTable({
						data: response.data,
						columns: columns

                    });
					
                }
            })
        });
        	
        
    });

</script>
@endsection

