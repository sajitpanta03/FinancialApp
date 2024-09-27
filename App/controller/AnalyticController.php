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
        $expenseData = (new Expenses())->getAllExpenses();
        
        $transactions = [];
        $currentHourTransactions = [];
        $currentHour = null;
    
        foreach ($expenseData as $data) {
            $timestamp = new \DateTime($data['created_at']);
            $hour = $timestamp->format('Y-m-d H'); 
    
            if ($currentHour !== $hour) {
                if ($currentHour !== null) {
                    $transactions[] = $currentHourTransactions;
                }
                $currentHour = $hour;
                $currentHourTransactions = [];
            }
    
            $currentHourTransactions[] = $data['name'];
        }
        
        if (!empty($currentHourTransactions)) {
            $transactions[] = $currentHourTransactions;
        }
    
        $minSupport = 0.1; 
        $minConfidence = 0.5; 
        
        $apriori = new Apriori($minSupport, $minConfidence);
        $apriori->loadTransactions($transactions);
        $apriori->run();
        
        $frequentItemsets = $apriori->getFrequentItemsets();
        $associationRules = $apriori->getAssociationRules();
        
        return view('/Analytic/apriori', [
            'transactions' => $transactions,
            'frequentItemsets' => $frequentItemsets,
            'associationRules' => $associationRules
        ]);
    }
    
    
    
    public function apioriReport()
    {
        $expenseData = (new Expenses())->getAllExpenses();
        
        $transactions = [];
        $currentHourTransactions = [];
        $currentHour = null;
    
        foreach ($expenseData as $data) {
            $timestamp = new \DateTime($data['created_at']);
            $hour = $timestamp->format('Y-m-d H');
    
            if ($currentHour !== $hour) {
                if ($currentHour !== null) {
                    $transactions[] = $currentHourTransactions;
                }
                $currentHour = $hour;
                $currentHourTransactions = [];
            }
    
            $currentHourTransactions[] = $data['name'];
        }
    
        if (!empty($currentHourTransactions)) {
            $transactions[] = $currentHourTransactions;
        }
    
        $minSupport = 0.5; 
        $minConfidence = 0.8;
    
        $apriori = new Apriori($minSupport, $minConfidence);
        $apriori->loadTransactions($transactions);
        $apriori->run();
    
        $frequentItemsets = $apriori->getFrequentItemsets();
        $associationRules = $apriori->getAssociationRules();
    
        $csvContent = $this->generateCsvContent($transactions, $frequentItemsets, $associationRules);
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="apriori_report.csv"');
        echo $csvContent;
        exit;
    }
    
    private function generateCsvContent($transactions, $frequentItemsets, $associationRules)
    {
        $output = fopen('php://temp', 'r+');
    
        fputcsv($output, ['Transaction ID', 'Items']);
        foreach ($transactions as $index => $transaction) {
            fputcsv($output, [$index + 1, implode(', ', $transaction)]);
        }
    
        fputcsv($output, []); 
    
        fputcsv($output, ['Frequent Itemsets', 'Support']);
        foreach ($frequentItemsets as $itemsetData) {
            fputcsv($output, [implode(', ', $itemsetData['itemset']), $itemsetData['support']]);
        }
    
        fputcsv($output, []); 
    
        fputcsv($output, ['Association Rule', 'Confidence']);
        foreach ($associationRules as $rule) {
            $ruleStr = implode(', ', $rule['rule'][0]) . ' => ' . implode(', ', $rule['rule'][1]);
            fputcsv($output, [$ruleStr, $rule['confidence']]);
        }
    
        rewind($output);
        return stream_get_contents($output);
    }

    public function MonteCarlo() {
        $monteCarlo = new MonteCarlo();

        $simulationResults = $monteCarlo->run();

        return view('/Analytic/monteCarlo', [
            'results' => $simulationResults,  
            'averageSavings' => $this->calculateAverage($simulationResults),
        ]);
    }

    private function calculateAverage($simulationResults) {
        if (count($simulationResults) === 0) return 0;
        return array_sum($simulationResults) / count($simulationResults);
    }

    
}
