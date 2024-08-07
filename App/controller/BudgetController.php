<?php
namespace App\controller;

use App\model\Budgets;
use Exception;

class BudgetController
{
    private $budgets;

    public function __construct()
    {
        $this->budgets = new Budgets();
    }

    public function budgetPage()
    {
        return view('/UserDashboard/userPageBudget');
    }

    public function showBudgets()
    {
        $budgets = $this->budgets->getAllBudgets();
        return view('/UserDashboard/userPageBudget', ['budgets' => $budgets]);
    }

    public function showAdd()
    {
        return view('/Budget/addBudget');
    }

    public function storeBudget()
    {
        $data = $_POST;

        $requiredFields = ['name', 'total_amount', 'start_date', 'end_date', 'user_id'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (empty($missingFields)) {
            $result = $this->budgets->storeBudget($data);

            if ($result) {
                header('Location: budget');
            } else {
                echo "Failed to store budget.";
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo "Invalid input data. Missing fields: " . implode(', ', $missingFields);
        }
    }

    public function showEdit($id)
    {
        try {
            $budget = $this->budgets->getBudgetById($id);
            return view('/Budget/editBudget', ['budget' => $budget]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function editBudget()
    {
        $data = [
            'id' => $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'total_amount' => $_POST['total_amount'] ?? null,
            'start_date' => $_POST['start_date'] ?? null,
            'end_date' => $_POST['end_date'] ?? null,
            'user_id' => $_POST['user_id'] ?? null
        ];

        print_r($data);

        $requiredFields = ['name', 'total_amount', 'start_date', 'end_date'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            return [
                'success' => false,
                'message' => 'Missing fields: ' . implode(', ', $missingFields)
            ];
        }

        $response = $this->budgets->editBudget($data);

        if ($response['success']) {
            header('Location: budget');
            exit;
        } else {
            return [
                'success' => false,
                'message' => $response['message']
            ];
        }
    }
    
    public function deleteBudget()
    {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            return view('/UserDashboard/userPageBudget', null, "Invalid request.");
        }

        $id = $_POST['id'];

        try {
            $result = $this->budgets->deleteBudget($id);

            if ($result) {
                return view('/UserDashboard/userPageBudget', null, "Expense deleted successfully!");
            } else {
                return view('/UserDashboard/userPageBudget', null, "Expense deletion unsuccessful!");
            }
        } catch (Exception $error) {
            return view('/UserDashboard/userPageBudget', null, "Sorry, error when deleting the expense: " . $error->getMessage());
        }
    }

    public function searchBudget()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            error_log("Search term: " . $searchTerm);
            $searchBudgets = $this->budgets->search($searchTerm);
            error_log(print_r($searchBudgets, true));
    
            if (!empty($searchBudgets)) {
                return view('/UserDashboard/userPageSearchBudget', ['searchBudgets' => $searchBudgets]);
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
}