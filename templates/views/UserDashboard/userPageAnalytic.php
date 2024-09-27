<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard Analytics</title>
    <link rel="stylesheet" type="text/css" href="assets/innerStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .top {
            display: flex;
            position: fixed;
            inset: 0px;
            width: 12rem;
            height: 5rem;
            max-width: 100vw;
            max-height: 100dvh;
            margin: auto;
            gap: 20px;
            top: 690px;
        }

        .top .button1 button,
        .top .button2 button {
            background-image: linear-gradient(90deg, #7b81ec, #3bd1d3);
            margin: 2em auto;
            display: block;
            -webkit-appearance: none;
            border: 6px solid rgba(255,255,255,0.45);
            border-radius: 50px;
            padding: 2em 4em;
            background-repeat: no-repeat;
            background-size: 100%;
            background-clip: padding-box;
            position: relative;
            color: black;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        .pie-chart-container {
            display: flex;
            position: fixed;
            inset: 0px;
            width: 12rem;
            height: 5rem;
            max-width: 100vw;
            max-height: 100dvh;
            margin: auto;
            gap: 20px;
            width: 600px; 
            height: auto;
            margin: 20px auto;
            text-align: center;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<?php include "userPage.php";?>

<div class="pie-chart-container">
    <canvas id="analyticPieChart" width="150" height="150" style="margin-top: 90px;"></canvas>
</div>

<div class="top">
    <div class="button1">
        <button onclick="location.href='monteCarlo'" type="button">
            MonteCarlo Simulation
        </button>
    </div>
    <div class="button2">
        <button onclick="location.href='apriori'" type="button">
            Apriori Algorithm    
        </button>
    </div>
</div>

<script>
    var ctx = document.getElementById('analyticPieChart').getContext('2d');
    var analyticPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Budget', 'Income', 'Goals'],
            datasets: [{
                data: [
                    <?php echo $budgetTotal; ?>,
                    <?php echo $incomeTotal; ?>,
                    <?php echo $goalTotal; ?>
                ],
                backgroundColor: [
                    'rgb(60, 60, 60, 60)',  
                    'rgba(54, 162, 235, 0.2)', 
                    'rgb(106, 90, 205, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>
