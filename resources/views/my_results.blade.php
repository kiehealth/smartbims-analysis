<x-riscc-layout>


<p class="text-left back"><a href="{{url('/myprofile')}}">&lt;&lt; {{__('lang.back')}}</a></p>
<div class="accordion" id="resultsAccordion">
<p class="lead"><h4 class="my-0 font-weight-normal text-center">{{__('lang.test-results')}}</h4></p>
@foreach ($myresults as $result)
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-justify" type="button" data-toggle="collapse" data-target="{{"#collapse".$loop->iteration}}" aria-expanded="false" aria-controls="{{"collapse".$loop->iteration}}">
          {{"#".$loop->iteration." ".__('lang.reporting-date')." ".$result->reporting_date}}
        </button>
      </h2>
    </div>

    <div id="{{"collapse".$loop->iteration}}" class="collapse" data-parent="#resultsAccordion">
      <div class="card-body">
      		<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.result')}}</li>
				<li class="list-inline-item">{{$result->final_reporting_result}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.reporting-date')}}</li>
				<li class="list-inline-item">{{$result->reporting_date}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.order-date')}}</li>
				<li class="list-inline-item">{{Carbon\Carbon::parse($result->kit->order->created_at)->timezone('Europe/Stockholm')->toDateString()}}</li>
			</ul>
      		<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.sample-registered-date')}}</li>
				<li class="list-inline-item">{{$result->sample_registered_date}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">{{__('lang.result-message')}}</li>
				<li class="list-inline-item">{!! config("constants.messages.RESULT_MESSAGE.$result->final_reporting_result") !!}</li>
			</ul>
      </div>
    </div>
  </div>
@endforeach
</div>


</x-riscc-layout>



