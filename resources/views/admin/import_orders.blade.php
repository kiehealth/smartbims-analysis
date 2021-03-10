@extends('admin.dashboard')



@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Import Orders</h5>
        @if(session('orders_import_success'))
    		<div class="alert alert-success">{{ session('orders_import_success') }}</div>
    	@endif
    	
    	
    	@if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{!! $error !!}</li>
                    @endforeach
                </ul>
              </div><br />
        @endif
    	
    	@if(session('errors_msg'))
              <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors_msg') as $error)
                      <li>{!! $error !!}</li>
                    @endforeach
                </ul>
              </div><br />
        @endif
            
    	<form method="post" action="{{action('OrderController@importOrderSave')}}" enctype="multipart/form-data">
    	@csrf
        <div class="input-group">
          	<div class="input-group-prepend">
            	<span class="input-group-text" id="orders_file_upload">Upload</span>
          	</div>
          	<div class="custom-file">
                <input type="file" class="custom-file-input" name="orders_file"
                  aria-describedby="orders_file_upload">
                <label class="custom-file-label" for="orders_file">Choose file</label>
          	</div>
    	</div>
        <p class="card-text">Use the excel/csv <a href="{{asset('storage/import_templates/orders_import_template.xlsx')}}">file template</a> to import the orders.</p>
        <button type="submit" class="btn btn-primary">Import</button>
        <a class="btn btn-secondary" href="{{url('/admin/orders')}}" role="button">Back</a>
        </form>
    </div>
</div>


<script type="text/javascript">
<!--

//-->
$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);
})
</script>
@endsection


