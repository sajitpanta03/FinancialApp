<?php

namespace App\controller;

require_once __DIR__ . '/../model/Goals.php';

use App\model\Goals;
use Exception;

class GoalController
{
    public $goals;

    public function __construct()
    {
        $this->goals = new Goals();
    }

    public function goalPage()
    {
        return view('/UserDashboard/userPageGoal');
    }

    public function showGoal()
    {
        $allGoals = $this->goals->getAllGoals();
        return view('/UserDashboard/userPageGoal', ['goals' => $allGoals]);
    }

    public function showAdd()
    {
        return view('/Goal/addGoal');
    }

    public function storeGoal()
    {
        $data = $_POST;

        $requiredFields = ['name', 'target_amount', 'target_date', 'risk_tolerance'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (empty($missingFields)) {
            $result = $this->goals->storeGoal($data);

            if ($result) {
                header('Location: goal');
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
            $goal = $this->goals->getGoalById($id);
            return view('/Goal/editGoal', ['goal' => $goal]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function editGoal()
    {
        $data = [
            'id' => $_POST['id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'target_amount' => $_POST['target_amount'] ?? null,
            'target_date' => $_POST['target_date'] ?? null,
            'risk_tolerance' => $_POST['risk_tolerance'] ?? null,
        ];

        $requiredFields = ['name', 'target_amount', 'target_date', 'risk_tolerance'];
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

        $response = $this->goals->editGoal($data);

        if ($response['success']) {
            header('Location: goal');
            exit;
        } else {
            return [
                'success' => false,
                'message' => $response['message'],
            ];
        }
    }

    public function deleteGoal()
    {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            return view('/UserDashboard/userPageGoal', null, "Invalid request.");
        }

        $id = $_POST['id'];

        try {
            $result = $this->goals->deleteGoal($id);

            if ($result) {
                return view('/UserDashboard/userPageGoal', null, "Goal deleted successfully!");
            } else {
                return view('/UserDashboard/userPageGoal', null, "Goal deletion unsuccessful!");
            }
        } catch (Exception $error) {
            return view('/UserDashboard/userPageGoal', null, "Sorry, error when deleting the goal: " . $error->getMessage());
        }
    }

    public function searchGoals()
    {
        error_log('searchGoals method called');

        $searchGoals = [];

        if (isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            error_log("Search term: " . $searchTerm);
            $searchGoals = $this->goals->search($searchTerm);
            error_log(print_r($searchGoals, true));
        }

        if (!empty($searchGoals)) {
            return view('/UserDashboard/userPageSearch', ['searchGoals' => $searchGoals]);
        }

        error_log('No search results found.');
    }

}
