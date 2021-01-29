@extends('home')

@section('content')
<p class="text-left back"><a href="{{url('/profile')}}">&lt;&lt; Tillbaka</a></p>
<div class="accordion" id="resultsAccordion">
<p class="lead"><h4 class="my-0 font-weight-normal text-center">Mina Provsvar</h4></p>
@foreach ($myresults as $result)
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-justify" type="button" data-toggle="collapse" data-target="{{"#collapse".$loop->iteration}}" aria-expanded="false" aria-controls="{{"collapse".$loop->iteration}}">
          {{"#".$loop->iteration." Rapporterad Datum ".$result->reporting_date}}
        </button>
      </h2>
    </div>

    <div id="{{"collapse".$loop->iteration}}" class="collapse" data-parent="#resultsAccordion">
      <div class="card-body">
      		<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Result</li>
				<li class="list-inline-item">{{$result->cobas_result}}</li>
			</ul>
      		<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Prov Registrerad Datum</li>
				<li class="list-inline-item">{{$result->sample_registered_date}}</li>
			</ul>
      </div>
    </div>
  </div>
@endforeach
</div>

@endsection



