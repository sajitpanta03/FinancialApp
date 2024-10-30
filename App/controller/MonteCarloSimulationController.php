<?php
namespace App\controller;

class MonteCarloSimulationController {
    private $conn;
    private $numSimulations;
    private $userId;

    public function __construct() {
        $this->conn = new \Database;
        $this->conn = $this->conn->dbConnection();
        $this->userId = 2;
        $this->numSimulations = 10;
    }

    private function getRandomValue($value) {
        $variation = mt_rand(-20, 20) / 100;
        return $value * (1 + $variation);
    }

    private function fetchIncomes() {
        $result = $this->conn->query("SELECT amount FROM incomes WHERE user_id = {$this->userId}");
        $incomes = [];
        while ($row = $result->fetch_assoc()) {
            $incomes[] = $row['amount'];
        }
        return $incomes;
    }

    private function fetchExpenses() {
        $result = $this->conn->query("SELECT amount FROM expenses WHERE user_id = {$this->userId}");
        $expenses = [];
        while ($row = $result->fetch_assoc()) {
            $expenses[] = $row['amount'];
        }
        return $expenses;
    }

    public function run() {
        $incomes = $this->fetchIncomes();
        $expenses = $this->fetchExpenses();

        $simulationResults = [];
        for ($i = 0; $i < $this->numSimulations; $i++) {
            $totalIncome = 0;
            $totalExpenses = 0;

            foreach ($incomes as $income) {
                $totalIncome += $this->getRandomValue($income);
            }

            foreach ($expenses as $expense) {
                $totalExpenses += $this->getRandomValue($expense);
            }

            $netSavings = $totalIncome - $totalExpenses;
            $simulationResults[] = $netSavings;
        }
        return $simulationResults;
    }
}