<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monte Carlo Simulation Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Style for the loading message */
        #loadingMessage {
            font-size: 1.5em;
            text-align: center;
            margin-top: 20px;
        }
        #chartContainer {
            display: none; /* Initially hidden while loading */
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Monte Carlo Simulation Results</h1>
    
    <!-- Loading message -->
    <div id="loadingMessage">Loading simulation results, please wait...</div>

    <!-- Chart container (hidden initially) -->
    <div id="chartContainer">
        <p>Average Savings: <?php echo $averageSavings; ?></p>

        <!-- Canvas for the chart -->
        <canvas id="simulationChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Show the loading message for 4 seconds, then hide it and show the chart
        setTimeout(function () {
            document.getElementById('loadingMessage').style.display = 'none';
            document.getElementById('chartContainer').style.display = 'block';

            // Prepare the data from PHP for use in JavaScript
            var simulationResults = <?php echo json_encode($results); ?>;
            
            // Render the data using Chart.js
            var ctx = document.getElementById('simulationChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',  // You can choose different chart types (e.g., bar, line, pie)
                data: {
                    labels: simulationResults.map((_, index) => `Run ${index + 1}`),
                    datasets: [{
                        label: 'Net Savings',
                        data: simulationResults,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Simulation Run'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Net Savings'
                            }
                        }
                    }
                }
            });
        }, 4000); // 4 seconds delay
    </script>

    <!-- Explanation of the chart -->
    <div id="chartExplanation">
        <h2>What does this chart represent?</h2>
        <p>This line chart represents the results of the Monte Carlo simulation, which runs multiple scenarios of your future financial situation.</p>
        <p><strong>Simulation Runs (X-Axis):</strong> Each point on the X-axis corresponds to one simulation run, showing one possible outcome based on random variations in your income and expenses.</p>
        <p><strong>Net Savings (Y-Axis):</strong> The Y-axis shows the net savings for each simulation run, calculated by subtracting your expenses from your income.</p>
        <p>If the line moves upwards, it indicates a positive outcome where income exceeds expenses. If the line dips downwards, it shows a negative outcome where expenses exceed income.</p>
        <p>The chart gives you a visual representation of the range of possible outcomes, helping you understand how your savings could fluctuate in different scenarios.</p>
    </div>

</body>
</html>
