<?php

namespace App\controller;

use App\model\Budgets;
use App\model\Expenses;
use App\model\Goals;
use App\model\Incomes;
use App\utils\Apriori;
use App\utils\MonteCarlo;

class AnalyticController
{
    public function showAnalytic()
    {
        $budgetTotal = (new Budgets())->getUserBudgetsTotal();
        $incomeTotal = (new Incomes())->getUserIncomesTotal();
        $goalTotal = (new Goals())->getUserGoalsTotal();

        return view('/UserDashboard/userPageAnalytic', [
            'budgetTotal' => $budgetTotal,
            'incomeTotal' => $incomeTotal,
            'goalTotal' => $goalTotal,
        ]);
    }

    public function apriori()
    {
        // Fetch all expenses with their timestamps from the database
        $expenseData = (new Expenses())->getAllExpenses();
        
        // Group expenses by 1-hour intervals
        $transactions = [];
        $currentHourTransactions = [];
        $currentHour = null;
    
        foreach ($expenseData as $data) {
            $timestamp = new \DateTime($data['created_at']);
            $hour = $timestamp->format('Y-m-d H'); // Group by hour
    
            if ($currentHour !== $hour) {
                // If moving to a new hour, save the previous hour's transactions
                if ($currentHour !== null) {
                    $transactions[] = $currentHourTransactions;
                }
                $currentHour = $hour;
                $currentHourTransactions = [];
            }
    
            // Add the item to the current hour's transaction
            $currentHourTransactions[] = $data['name'];
        }
        
        // Add the last set of transactions
        if (!empty($currentHourTransactions)) {
            $transactions[] = $currentHourTransactions;
        }
    
        // Apply Apriori algorithm
        $minSupport = 0.5; // Lower support threshold
        $minConfidence = 0.8; // Lower confidence threshold
        
        $apriori = new Apriori($minSupport, $minConfidence);
        $apriori->loadTransactions($transactions);
        $apriori->run();
        
        $frequentItemsets = $apriori->getFrequentItemsets();
        $associationRules = $apriori->getAssociationRules();
        
        // Pass the data to the view
        return view('/Analytic/apriori', [
            'transactions' => $transactions,
            'frequentItemsets' => $frequentItemsets,
            'associationRules' => $associationRules
        ]);
    }
    
    
    
    public function apioriReport()
    {
        // Fetch all expenses with their timestamps from the database
        $expenseData = (new Expenses())->getAllExpenses();
        
        // Group expenses by 1-hour intervals
        $transactions = [];
        $currentHourTransactions = [];
        $currentHour = null;
    
        foreach ($expenseData as $data) {
            $timestamp = new \DateTime($data['created_at']);
            $hour = $timestamp->format('Y-m-d H'); // Group by hour
    
            if ($currentHour !== $hour) {
                // If moving to a new hour, save the previous hour's transactions
                if ($currentHour !== null) {
                    $transactions[] = $currentHourTransactions;
                }
                $currentHour = $hour;
                $currentHourTransactions = [];
            }
    
            // Add the item to the current hour's transaction
            $currentHourTransactions[] = $data['name'];
        }
    
        // Add the last set of transactions
        if (!empty($currentHourTransactions)) {
            $transactions[] = $currentHourTransactions;
        }
    
        $minSupport = 0.5; // Lower support threshold
        $minConfidence = 0.8; // Lower confidence threshold
    
        $apriori = new Apriori($minSupport, $minConfidence);
        $apriori->loadTransactions($transactions);
        $apriori->run();
    
        $frequentItemsets = $apriori->getFrequentItemsets();
        $associationRules = $apriori->getAssociationRules();
    
        // Generate CSV content
        $csvContent = $this->generateCsvContent($transactions, $frequentItemsets, $associationRules);
    
        // Send CSV file as a download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="apriori_report.csv"');
        echo $csvContent;
        exit;
    }
    
    private function generateCsvContent($transactions, $frequentItemsets, $associationRules)
    {
        $output = fopen('php://temp', 'r+');
    
        // Add headers for transactions
        fputcsv($output, ['Transaction ID', 'Items']);
        foreach ($transactions as $index => $transaction) {
            fputcsv($output, [$index + 1, implode(', ', $transaction)]);
        }
    
        fputcsv($output, []); // Empty row for separation
    
        // Add headers for frequent itemsets
        fputcsv($output, ['Frequent Itemsets', 'Support']);
        foreach ($frequentItemsets as $itemsetData) {
            fputcsv($output, [implode(', ', $itemsetData['itemset']), $itemsetData['support']]);
        }
    
        fputcsv($output, []); // Empty row for separation
    
        // Add headers for association rules
        fputcsv($output, ['Association Rule', 'Confidence']);
        foreach ($associationRules as $rule) {
            $ruleStr = implode(', ', $rule['rule'][0]) . ' => ' . implode(', ', $rule['rule'][1]);
            fputcsv($output, [$ruleStr, $rule['confidence']]);
        }
    
        rewind($output);
        return stream_get_contents($output);
    }

    // Custom function to render the simulation results in a view
    public function MonteCarlo() {
        // Initialize Monte Carlo object
        $monteCarlo = new MonteCarlo();

        // Run the simulation to get the results
        $simulationResults = $monteCarlo->run();

        // Pass the results to the custom view function (view method)
        return view('/Analytic/monteCarlo', [
            'results' => $simulationResults,  // Pass simulation data
            'averageSavings' => $this->calculateAverage($simulationResults),  // Example of adding additional analysis
        ]);
    }

    // A helper function to calculate the average of the simulation results (optional)
    private function calculateAverage($simulationResults) {
        if (count($simulationResults) === 0) return 0;
        return array_sum($simulationResults) / count($simulationResults);
    }

    
}
