<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pie Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
  <h1 style="text-align: center; color: red;">Pie Chart In Laravel</h1>
  <div style="width: 900px; margin:auto;"> <canvas id="chart"></canvas>
  </div>
  <script>
    var ctx = document.getElementById('chart').getContext('2d');
    var userChart = new Chart(ctx, {
      type: 'pie',  // Changed 'bar' to 'pie' for Pie Chart
      data: {
        labels: {!! json_encode($labels) !!}, // Use $labels passed from controller
        datasets: {!! json_encode($datasets) !!}, // Use $datasets passed from controller
      }
    });
  </script>
</body>
</html>
