<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
    <h1 style="text-align: center; color: red;">Bar Chart In Laravel</h1>
    <div style="width: 900px; margin:auto;"> <!-- Added "auto" to center align -->
        <canvas id="chart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var userChart = new Chart(ctx, { // Corrected 'newChart' to 'new Chart'
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: {!! json_encode($datasets) !!} // Corrected '#datasets' to '$datasets'
            }
        });
    </script>
</body>
</html>
