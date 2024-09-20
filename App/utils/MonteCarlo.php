<?php
namespace App\utils;

class MonteCarlo {
    private $conn;
    private $numSimulations;
    private $userId;
    private $incomeVariation;  // Allow dynamic variation input
    private $expenseVariation;

    // Constructor accepts dynamic parameters for number of simulations and variation ranges
    public function __construct($numSimulations = 1000, $incomeVariation = 20, $expenseVariation = 20) {
        // Start session if it hasn't been started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure user_id is set in the session
        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
        } else {
            // Handle the case where no user is logged in (default to userId = 0 or throw an exception)
            throw new \Exception("User not logged in. Session user_id not found.");
        }

        // Database connection setup
        $this->conn = new \Database;
        $this->conn = $this->conn->dbConnection();

        // Set dynamic input for number of simulations and income/expense variation
        $this->numSimulations = $numSimulations;
        $this->incomeVariation = $incomeVariation;  // % variation for income
        $this->expenseVariation = $expenseVariation;  // % variation for expenses
    }

    // Generate random value with controlled variation for incomes/expenses
    private function getRandomValue($value, $variation) {
        $randomFactor = mt_rand(-$variation, $variation) / 100;  // e.g., -20% to +20%
        return $value * (1 + $randomFactor);
    }

    // Fetch incomes for the user from the database
    private function fetchIncomes() {
        $result = $this->conn->query("SELECT amount FROM incomes WHERE user_id = {$this->userId}");
        $incomes = [];
        while ($row = $result->fetch_assoc()) {
            $incomes[] = $row['amount'];
        }
        return $incomes;
    }

    // Fetch expenses for the user from the database
    private function fetchExpenses() {
        $result = $this->conn->query("SELECT amount FROM expenses WHERE user_id = {$this->userId}");
        $expenses = [];
        while ($row = $result->fetch_assoc()) {
            $expenses[] = $row['amount'];
        }
        return $expenses;
    }

    // Run the Monte Carlo simulation
    public function run() {
        // Fetch user-specific incomes and expenses
        $incomes = $this->fetchIncomes();
        $expenses = $this->fetchExpenses();

        // Store simulation results for analysis
        $simulationResults = [];

        // Run simulations
        for ($i = 0; $i < $this->numSimulations; $i++) {
            $totalIncome = 0;
            $totalExpenses = 0;

            // Simulate random variations for incomes
            foreach ($incomes as $income) {
                $totalIncome += $this->getRandomValue($income, $this->incomeVariation);
            }

            // Simulate random variations for expenses
            foreach ($expenses as $expense) {
                $totalExpenses += $this->getRandomValue($expense, $this->expenseVariation);
            }

            // Calculate net savings for this simulation
            $netSavings = $totalIncome - $totalExpenses;
            $simulationResults[] = $netSavings;
        }

        // Return the results of all simulations
        return $simulationResults;
    }
}
