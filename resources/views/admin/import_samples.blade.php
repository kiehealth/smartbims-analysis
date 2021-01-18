@extends('admin.dashboard')



@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Import Samples</h5>
        @if(session('samples_import_success'))
    		<div class="alert alert-success">{{ session('samples_import_success') }}</div>
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
            
    	<form method="post" action="{{action('SampleController@importSampleSave')}}" enctype="multipart/form-data">
    	@csrf
        <div class="input-group">
          	<div class="input-group-prepend">
            	<span class="input-group-text" id="samples_file_upload">Upload</span>
          	</div>
          	<div class="custom-file">
                <input type="file" class="custom-file-input" name="samples_file"
                  aria-describedby="samples_file_upload">
                <label class="custom-file-label" for="samples_file">Choose file</label>
          	</div>
    	</div>
        <p class="card-text">Use the excel/csv <a href="{{asset('storage/import_templates/samples_import_template.xlsx')}}">file template</a> to import the kits.</p>
        <button type="submit" class="btn btn-primary">Import</button>
        <a class="btn btn-secondary" href="{{url('/admin/samples')}}" role="button">Back</a>
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


