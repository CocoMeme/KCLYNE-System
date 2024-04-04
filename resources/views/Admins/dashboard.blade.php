@extends('Layouts/header')
<body>

@if(session('success'))
        <div class="success-message-admin">
            {{ session('success') }}
        </div>
    @endif

@auth('admin') 
<section class="employee-management">
<div style="margin:auto;">
    <h1 style="text-align: center; color: red;">Pie Chart for Orders</h1>
    <div style="width: 800px; margin:auto;">
        <canvas id="pieChart"></canvas>
    <h1 style="text-align: center; color: red;">Line Chart for Stocks</h1>
    <div style="width: 800px; margin:auto;">
        <canvas id="lineChart"></canvas>
        <h1 style="text-align: center; color: red;">Bar Chart for Employee Documents</h1>
    <div style="width: 800px; margin:auto;">
        <canvas id="barChart"></canvas>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        var pieCtx = document.getElementById('pieChart').getContext('2d');

        var orderLabels = {!! json_encode($orderLabels) !!};
        var orderColors = orderLabels.map(function() {
            return '#' + Math.floor(Math.random()*16777215).toString(16);
        });

        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: orderLabels,
                datasets: [{
                    data: {!! json_encode($orderData) !!},
                    backgroundColor: orderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            generateLabels: function(chart) {
                                var data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, index) {
                                        var color = data.datasets[0].backgroundColor[index];
                                        return {
                                            text: label,
                                            fillStyle: color
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    }
                }
            }
        });

        var orderLabelsDiv = document.getElementById('orderLabels');
        orderLabels.forEach(function(label, index) {
            var labelSpan = document.createElement('span');
            labelSpan.style.display = 'block';
            labelSpan.style.color = orderColors[index];
            labelSpan.textContent = label;
            orderLabelsDiv.appendChild(labelSpan);
        });
    </script>

<script>
    var lineCtx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($stockLabels) !!},
            datasets: [{
                label: 'Stock Level',
                data: {!! json_encode($stockData) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var barCtx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($documentLabels) !!},
            datasets: [{
                label: 'Number of Documents',
                data: {!! json_encode($documentData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@else  

@endauth

    
</section>
</body>