@extends('admin.dashboard')

@section('dashboard_title')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

@endsection



@section('content')
<div class="canvas-container canvas-container-row">
    <div>
    	<canvas id="usersChart"></canvas>
    </div>
    <div>
    	<canvas id="ordersChart"></canvas>
    </div>
</div>
<div class="canvas-container canvas-container-row">
    <div>
    	<canvas id="kitsChart"></canvas>
    </div>
    <div>
    	<canvas id="samplesChart"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

var ctx_usersChart = document.getElementById('usersChart');
var usersChart = new Chart(ctx_usersChart, {
    type: 'doughnut',
    data: {
        labels: ['Total Participants', 'Participants with Orders', 'Participants without Orders'],
        datasets: [{
            data: [{{$count_total_users}}, {{$count_users_with_orders}}, {{$count_total_users-$count_users_with_orders}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Participants and Orders'
        }
    }
});




var ctx_ordersChart = document.getElementById('ordersChart');
var ordersChart = new Chart(ctx_ordersChart, {
    type: 'doughnut',
    data: {
        labels: ['Total Orders', 'Orders Processed (Kits Registered)', 'Orders Unprocessed (Kits Not Registered)'],
        datasets: [{
            data: [{{$count_total_orders}}, {{$count_total_orders-$count_unprocessed_orders}}, {{$count_unprocessed_orders}}],
            backgroundColor: [
                'rgba(204, 0, 204, 0.2)',
                'rgba(255, 204, 153, 0.2)',
                'rgba(0, 102, 51, 0.2)',
                
            ],
            borderColor: [
                'rgba(204, 0, 204, 1)',
                'rgba(255, 204, 153, 1)',
                'rgba(0, 102, 51, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Orders'
        }
    }
});




var ctx_kitsChart = document.getElementById('kitsChart');
var kitsChart = new Chart(ctx_kitsChart, {
    type: 'doughnut',
    data: {
        labels: ['Total Kits Registered', 'Kits Dispatched', 'Samples Received'],
        datasets: [{
            data: [{{$count_total_kits_registered}}, {{$count_dispatched_kits}}, {{$count_received_samples}}],
            backgroundColor: [
                'rgba(255, 102, 102, 0.2)',
                'rgba(153, 153, 0, 0.2)',
                'rgba(51, 255, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 102, 102, 1)',
                'rgba(153, 153, 0, 1)',
                'rgba(51, 255, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Kits'
        }
    }
});



var ctx_samplesChart = document.getElementById('samplesChart');
var samplesChart = new Chart(ctx_samplesChart, {
    type: 'doughnut',
    data: {
        labels: ['Total Samples Registered', 'Results Reported', 'Results Not Reported'],
        datasets: [{
            data: [{{$count_total_samples_registered}}, {{$count_results_received}}, {{$count_total_samples_registered-$count_results_received}}],
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Samples and Results'
        }
    }
});



</script>
@endsection

