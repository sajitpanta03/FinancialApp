<?php

namespace App\controller;

require_once __DIR__ . '/../model/Expenses.php';

use App\model\expenses;
use Exception;

class ExpenseController
{
    public $expenses;

    public function __construct()
    {
        $this->expenses = new Expenses();
    }

    public function expensePage()
    {
        return view('/UserDashboard/userPageExpense');
    }

    public function showExpense()
    {
        $allExpenses = $this->expenses->getAllExpenses();
        return view('/UserDashboard/userPageExpense', ['expenses' => $allExpenses]);
    }

    public function showAdd()
    {
        $budgetOfThatUser = $this->expenses->getBudgetName();
        return view('Expense/addExpense', ['budgetOfThatUser' => $budgetOfThatUser]);
    }

    public function storeExpense()
    {
        $data = $_POST;

        $requiredFields = ['name', 'description', 'amount', 'budget_id'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (empty($missingFields)) {
            $result = $this->expenses->storeExpense($data);

            if ($result) {
                header('Location: expense');
            } else {
                echo "Failed to store expense.";
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo "Invalid input data. Missing fields: " . implode(', ', $missingFields);
        }
    }

    public function showEdit($id)
    {
        try {
            $expense = $this->expenses->getExpenseById($id);
    
            $budget = $this->expenses->getBudgetById($expense['budget_id']);
    
            $budgets = $this->expenses->getBudgetName();
    
            return view('/Expense/editExpense', [
                'expense' => $expense,
                'budget' => $budget,
                'budgets' => $budgets
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    

    public function editExpense()
    {
        $data = [
            'id' => $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'description' => $_POST['description'] ?? null,
            'amount' => $_POST['amount'] ?? null,
            'budget_id' => $_POST['budget_id'] ?? null,
        ];


        $requiredFields = ['name', 'description', 'amount', 'budget_id'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            return [
                'success' => false,
                'message' => 'Missing fields: ' . implode(', ', $missingFields),
            ];
        }

        $response = $this->expenses->editExpense($data);

        if ($response['success']) {
            header('Location: expense');
            exit;
        } else {
            return [
                'success' => false,
                'message' => $response['message'],
            ];
        }
    }

    public function deleteExpense()
    {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            return view('/UserDashboard/userPageExpense', null, "Invalid request.");
        }

        $id = $_POST['id'];

        try {
            $result = $this->expenses->deleteExpense($id);

            if ($result) {
                return view('/UserDashboard/userPageExpense', null, "Expense deleted successfully!");
            } else {
                return view('/UserDashboard/userPageExpense', null, "Expense deletion unsuccessful!");
            }
        } catch (Exception $error) {
            return view('/UserDashboard/userPageExpense', null, "Sorry, error when deleting the expense: " . $error->getMessage());
        }
    }

    public function searchExpenses()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            error_log("Search term: " . $searchTerm);
            $searchExpenses = $this->expenses->search($searchTerm);
            error_log(print_r($searchExpenses, true));
    
            if (!empty($searchExpenses)) {
                return view('/UserDashboard/userPageSearchExpense', ['expenses' => $searchExpenses]);
            } else {
                error_log('No search results found.');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    

    public function getUserExpense()
    {
        try {
        $getUserExpense = $this->expenses->getUserExpense();
        return json_encode($getUserExpense);
        } catch (Exeception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
