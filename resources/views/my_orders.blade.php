@extends('home')

@section('content')
<p class="text-left back"><a href="{{url('/profile')}}">&lt;&lt; Tillbaka</a></p>
<div class="accordion" id="ordersAccordion">
<p class="lead"><h4 class="my-0 font-weight-normal text-center">Mina Beställningar</h4></p>
@foreach ($myorders as $order)
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-justify" type="button" data-toggle="collapse" data-target="{{"#collapse".$loop->iteration}}" aria-expanded="false" aria-controls="{{"collapse".$loop->iteration}}">
          {{"#".$loop->iteration." Beställning Datum ".$order->created_at->toDateString()}}
        </button>
      </h2>
    </div>

    <div id="{{"collapse".$loop->iteration}}" class="collapse" data-parent="#ordersAccordion">
      <div class="card-body">
      		<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Beställning Datum</li>
				<li class="list-inline-item">{{$order->created_at->toDateString()}}</li>
			</ul>
			<ul class="list-unstyled mt-3 mb-4 list-inline text-justify">
				<li class="list-inline-item font-weight-bold">Status</li>
				<li class="list-inline-item">{{$order->status}}</li>
			</ul>
      </div>
    </div>
  </div>
@endforeach
</div>

@endsection




@section('scripts')
<script type="text/javascript">
    /*$("#ordersAccordion").on('show.bs.collapse', function (e) {
    	$(e.target).prev('.card-header').find('.btn').addClass('font-weight-bold');
    });
    
    $('#ordersAccordion').on('hide.bs.collapse', function (e) {
    	$(this).find('.btn').not($(e.target)).removeClass('font-weight-bold');
    });*/
</script>
@endsection
