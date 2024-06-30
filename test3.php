<?php

// Step 1: Define Variables
$initialSavings = 100; // Initial savings amount
$monthlyIncome = 3500; // Monthly income
$monthlyExpenses = 2000; // Monthly expenses
$savingsRate = 0.2; // Savings rate as a percentage of income (10%)
$goalAmount = 110; // Financial goal amount
$timeHorizonMonths = 12; // Time horizon in months (1 year)
$numSimulations = 10000; // Number of simulations

// Historical investment returns for simulation (annualized)
$historicalReturns = [
    0.05, 0.07, 0.1, -0.03, 0.12, 0.08, 0.06, 0.09, 0.03, 0.11, 0.04, 0.05
];

// Calculate mean and standard deviation of historical returns
$meanReturn = array_sum($historicalReturns) / count($historicalReturns);
$stdDevReturn = sqrt(array_sum(array_map(function($x) use ($meanReturn) {
    return pow($x - $meanReturn, 2);
}, $historicalReturns)) / (count($historicalReturns) - 1));

// Function to generate random numbers from a normal distribution
function generateNormalRandom($mean, $stdDev) {
    $u = mt_rand() / mt_getrandmax();
    $v = mt_rand() / mt_getrandmax();
    $z = sqrt(-2 * log($u)) * cos(2 * pi() * $v);
    return $mean + $stdDev * $z;
}

// Step 2: Generate Random Samples and Simulate Financial Trajectories
$simulationResults = [];
for ($i = 0; $i < $numSimulations; $i++) {
    $savings = $initialSavings;
    for ($j = 0; $j < $timeHorizonMonths; $j++) {
        // Generate a random return for the month
        $randomReturn = generateNormalRandom($meanReturn, $stdDevReturn);
        // Calculate monthly savings
        $monthlySavings = ($monthlyIncome - $monthlyExpenses) * $savingsRate;
        // Update savings with the monthly savings
        $savings += $monthlySavings;
        // Apply the random investment return (converted to monthly)
        $savings *= (1 + $randomReturn / 12);
    }
    $simulationResults[] = $savings;
}

// Step 3: Analyze Results
// Sort the simulation results to find percentiles and median
sort($simulationResults);

// Calculate the mean final portfolio value
$meanFinalValue = array_sum($simulationResults) / count($simulationResults);

// Calculate the 90% Value at Risk (VaR)
$VaR90 = $simulationResults[intval(0.1 * $numSimulations)];

// Calculate the median final portfolio value
$medianFinalValue = $simulationResults[intval(0.5 * $numSimulations)];

// Count how many simulations achieved the financial goal
$achievedGoalCount = count(array_filter($simulationResults, function($finalSavings) use ($goalAmount) {
    return $finalSavings >= $goalAmount;
}));

// Calculate the probability of achieving the financial goal
$probabilityOfAchievingGoal = ($achievedGoalCount / $numSimulations) * 100;

// Output the results
echo "Probability of Achieving Financial Goal: " . number_format($probabilityOfAchievingGoal, 2) . "%\n";
echo "Median Final Portfolio Value: $" . number_format($medianFinalValue, 2) . "\n";
echo "90% Value at Risk (VaR): $" . number_format($VaR90, 2) . "\n";

?>
