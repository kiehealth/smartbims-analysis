@extends('admin.dashboard')

@section('dashboard_title')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

@endsection



@section('content')
<div class="canvas-container">
 <div>
 <canvas id="usersChart"></canvas>
 </div>
 <div>
 <canvas id="ordersChart"></canvas>
 </div>
 <div>Right Stuff</div>
</div>
    
    
@endsection

@section('scripts')
<script type="text/javascript">
var ctx = document.getElementById('usersChart');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Total Participants', 'Participants with Orders', 'Participants without Orders'],
        datasets: [{
            label: '# of Participants',
            data: [{{$count_non_admin_users}}, {{$count_users_with_orders}}, {{$count_non_admin_users-$count_users_with_orders}}],
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
        responsive: true
    }
});




var ctx = document.getElementById('ordersChart');
var myChart1 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Total Participants', 'Participants with Orders', 'Participants without Orders'],
        datasets: [{
            label: '# of Participants',
            data: [{{$count_non_admin_users}}, {{$count_users_with_orders}}, {{$count_non_admin_users-$count_users_with_orders}}],
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
        responsive: true
    }
});
</script>
@endsection

