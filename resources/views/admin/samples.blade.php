@extends('admin.dashboard')

@section('dashboard_title')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('lang.Sample Results')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href='{{action('SampleController@import')}}'>
            	<button type="button" class="btn btn-sm btn-outline-secondary">{{__('lang.Import Samples/Results')}}</button>
            </a>
          </div>
</div>
@endsection



@section('content')
@if(session('sample_updated'))
	<div class="alert alert-success">{{ session('sample_updated') }}</div>
@endif
@if(session('sample_deleted'))
	<div class="alert alert-success">{{ session('sample_deleted') }}</div>
@endif

    <table id="samples_table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th class="noexport">S.N</th>
                <th>Sample Key</th>
                <th>SampleID</th>
                <th>Order ID</th>
                <th>Kit ID</th>
                <th>LabID</th>
                <th>Name</th>
                <th>Email</th>
                <th>SSN</th>
                <th>Sample Registered Date</th>
                <th>Cobas Result</th>
                <th>Cobas Analysis Date</th>
                <th>Luminex Result</th>
                <th>Luminex Analysis Date</th>
                <th>RT PCR Result</th>
                <th>RT PCR Analysis Date</th>
                <th>Final Reporting Result</th>
                <th>Reporting Date</th>
                <th>Reported Via</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th class="noexport">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($samples as $sample)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$sample->id}}</td>
                <td>{{$sample->sample_id}}</td>
                <td>{{$sample->kit->order->id}}</td>
                <td>{{$sample->kit->id}}</td>
                <td>{{$sample->lab_id}}</td>
                <td>{{$sample->kit->user->name}}</td>
                <td>{{$sample->kit->user->email}}</td>
                <td>{{$sample->kit->user->ssn}}</td>
                <td>{{$sample->sample_registered_date}}</td>
                <td>{{$sample->cobas_result}}</td>
                <td>{{$sample->cobas_analysis_date}}</td>
                <td>{{$sample->luminex_result}}</td>
                <td>{{$sample->luminex_analysis_date}}</td>
                <td>{{$sample->rtpcr_result}}</td>
                <td>{{$sample->rtpcr_analysis_date}}</td>
                <td>{{$sample->final_reporting_result}}</td>
                <td>{{$sample->reporting_date}}</td>
                <td>{{$sample->reported_via}}</td>
                <td>{{Carbon\Carbon::parse($sample->created_at)->timezone('Europe/Stockholm')->toDateTimeString()}}</td>
                <td>{{Carbon\Carbon::parse($sample->updated_at)->timezone('Europe/Stockholm')->toDateTimeString()}}</td>
                <td>
                
                
                
                <a href="{{url("/admin/samples/".$sample->id."/edit")}}" >
                <button class="btn btn-outline-primary" type="button" data-toggle="tooltip" title="{{ __('lang.Edit Sample Information') }}">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  				<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
				</svg>
				</button>
				</a>
				
				<form action="{{action('SampleController@destroy', ['id' => $sample->id])}}" method="post" onsubmit="return confirm('{{__('lang.Are you sure you want to delete the sample?')}}');">
				@csrf
				@method("DELETE")
				<button class="btn btn-outline-danger" type="submit" data-toggle="tooltip" title="{{ __('lang.Delete Sample') }}">
    				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    	<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    	<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
				</button>
				</form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
        $('#samples_table').DataTable({
            dom: 'Blfrtip',
            "scrollX": true,
            "language": {
                "url": "{{asset('lang/'.LaravelLocalization::getCurrentLocale().'/datatables.json')}}"
            },
            buttons: [
                'colvis', 
                {
                	extend: 'copy',
                	title: 'Samples Export',
                    exportOptions: {
                        columns: [1, ':visible:not(.noexport)']
                    }
                },
                {
                	extend: 'csv',
                	title: 'Samples Export',
                    exportOptions: {
                        columns: [1, ':visible:not(.noexport)']
                    }

                 },
                 {
                 	extend: 'excel',
                 	title: 'Samples Export',
                     exportOptions: {
                         columns: [1, ':visible:not(.noexport)']
                     }

                  },
                  {
                  	extend: 'pdf',
                  	title: 'Samples Export',
                      exportOptions: {
                          columns: [1, ':visible:not(.noexport)']
                      }

                   },
                   {
                   	extend: 'print',
                   	title: 'Samples Export',
                       exportOptions: {
                           columns: [1, ':visible:not(.noexport)']
                       }

                    }
            ],
            "columnDefs": [
                { "visible": false, "targets": 1 }
            ]
        });
    });

</script>
@endsection

