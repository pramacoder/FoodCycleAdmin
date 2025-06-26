@extends('layouts.app')

@section('content')
<div class="income-chart">
    <h2>Income Overview</h2>
    <canvas id="incomeChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('incomeChart').getContext('2d');
    var incomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Income',
                data: {!! json_encode($incomes) !!},
                borderColor: 'rgb(75, 192, 192)',
                fill: false
            }]
        }
    });
</script>
@endsection
