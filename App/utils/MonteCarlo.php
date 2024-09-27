<?php
namespace App\utils;

class MonteCarlo {
    private $conn;
    private $numSimulations;
    private $userId;
    private $incomeVariation; 
    private $expenseVariation;

   
    public function __construct($numSimulations = 1000, $incomeVariation = 20, $expenseVariation = 20) {
  
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

     
        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
        } else {

            throw new \Exception("User not logged in. Session user_id not found.");
        }

      
        $this->conn = new \Database;
        $this->conn = $this->conn->dbConnection();

 
        $this->numSimulations = $numSimulations;
        $this->incomeVariation = $incomeVariation;  
        $this->expenseVariation = $expenseVariation; 
    }

   
    private function getRandomValue($value, $variation) {
        $randomFactor = mt_rand(-$variation, $variation) / 100; 
        return $value * (1 + $randomFactor);
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
                $totalIncome += $this->getRandomValue($income, $this->incomeVariation);
            }

   
            foreach ($expenses as $expense) {
                $totalExpenses += $this->getRandomValue($expense, $this->expenseVariation);
            }

     
            $netSavings = $totalIncome - $totalExpenses;
            $simulationResults[] = $netSavings;
        }


        return $simulationResults;
    }
}
