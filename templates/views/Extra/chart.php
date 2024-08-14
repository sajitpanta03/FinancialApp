<?php

// Encode results as JSON for use in JavaScript
$simulationResultsJson = json_encode($simulationResults);

print_r($simulationResultsJson);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/innerStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Analytic</title>
</head>

<body>

    <div class="table-wrapper">
    <h2>Monte Carlo Simulation Results</h2>
    <canvas id="simulationChart" width="800" height="400"></canvas>
    <script>
        // Get simulation results from PHP
        const simulationResults = <?php echo $simulationResultsJson; ?>;

        // Prepare data for Chart.js
        const data = {
            labels: Array.from({length: simulationResults.length}, (_, i) => i + 1),
            datasets: [{
                label: 'Net Savings',
                data: simulationResults,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configure and create the chart
        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const ctx = document.getElementById('simulationChart').getContext('2d');
        new Chart(ctx, config);
    </script>
    </div>
</body>

</html>