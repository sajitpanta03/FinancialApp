<?php
namespace App\controller;

use App\model\Incomes;
use Exception;

class IncomeController
{
    private $incomes;

    public function __construct()
    {
        $this->incomes = new Incomes();
    }

    public function incomePage()
    {
        return view('/UserDashboard/userPageIncome');
    }

    public function showIncomes()
    {
        $incomes = $this->incomes->getAllIncomes();
        return view('/UserDashboard/userPageIncome', ['incomes' => $incomes]);
    }

    public function showAdd()
    {
        return view('/Income/addIncome');
    }

    public function storeIncome()
    {
        $data = $_POST;

        $requiredFields = ['name', 'amount', 'type', 'user_id'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (empty($missingFields)) {
            $result = $this->incomes->storeIncome($data);

            if ($result) {
                header('Location: income');
            } else {
                echo "Failed to store goal.";
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo "Invalid input data. Missing fields: " . implode(', ', $missingFields);
        }
    }

    public function showEdit($id)
    {
        try {
            $income = $this->incomes->getIncomeById($id);
            return view('/Income/editIncome', ['income' => $income]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function editIncome()
    {
        $data = [
            'id' => $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'amount' => $_POST['amount'] ?? null,
            'type' => $_POST['type'] ?? null,
            'user_id' => $_POST['user_id'] ?? null
        ];

        $requiredFields = ['name', 'amount', 'type'];
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

        $response = $this->incomes->editIncome($data);

        if ($response['success']) {
            header('Location: income');
            exit;
        } else {
            return [
                'success' => false,
                'message' => $response['message']
            ];
        }
    }
    
    public function deleteIncome()
    {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            return view('/UserDashboard/userPageGoal', null, "Invalid request.");
        }

        $id = $_POST['id'];

        try {
            $result = $this->incomes->deleteIncome($id);

            if ($result) {
                return view('/UserDashboard/userPageIncome', null, "Goal deleted successfully!");
            } else {
                return view('/UserDashboard/userPageIncome', null, "Goal deletion unsuccessful!");
            }
        } catch (Exception $error) {
            return view('/UserDashboard/userPageIncome', null, "Sorry, error when deleting the goal: " . $error->getMessage());
        }
    }

    public function searchIncomes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            error_log("Search term: " . $searchTerm);
            $searchIncomes = $this->incomes->search($searchTerm);
            error_log(print_r($searchIncomes, true));
    
            if (!empty($searchIncomes)) {
                return view('/UserDashboard/userPageSearchIncome', ['searchIncomes' => $searchIncomes]);
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