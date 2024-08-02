<?php

namespace App\model;

class Goals
{
    protected $conn;
    private $table_name = "goals";
    protected $fillable = ['name', 'target_amount', 'risk_tolerance'];

    public function __construct()
    {
        $this->conn = new \Database();
        $this->conn = $this->conn->dbConnection();
    }

    public function getAllGoals(): array
    {
        $user_id = $this->sessionStart();

        if (!$user_id) {
            return [];
        }

        $sql = "SELECT * FROM $this->table_name WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        $goals = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $goals[] = $row;
            }
        }

        return $goals;
    }

    public function getUserGoalsTotal()
    {
        $user_id = $this->sessionStart();

        if (!$user_id) {
            return 0;
        }

        $sql = "SELECT SUM(target_amount) as total FROM $this->table_name WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception($this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();

        $stmt->close();
        return $total ?? 0;
    }

    public function storeGoal($data)
    {
        $user_id = $this->sessionStart();

        $sql = "INSERT INTO goals (name, target_amount, target_date, risk_tolerance, budget_id, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception($this->conn->error);
        }

        $stmt->bind_param(
            'sdssii',
            $data['name'],
            $data['target_amount'],
            $data['target_date'],
            $data['risk_tolerance'],
            $data['budget_id'],
            $user_id
        );

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getGoalById($id)
    {
        $user_id = $this->sessionStart();

        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name WHERE id = ? AND user_id = ?");

        if (!$stmt) {
            die('Error in preparing statement: ' . $this->conn->error);
        }

        $stmt->bind_param('ii', $id, $user_id);

        if (!$stmt->execute()) {
            die('Error in executing statement: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if (!$result) {
            die('Error in getting result set: ' . $stmt->error);
        }

        $goal = $result->fetch_assoc();

        $stmt->close();

        return $goal;
    }

    public function getUserGoal()
    {
        $user_id = $this->sessionStart();

        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name WHERE user_id = ?");

        if (!$stmt) {
            die('Error in preparing statement: ' . $this->conn->error);
        }

        $stmt->bind_param('i', $user_id);

        if (!$stmt->execute()) {
            die('Error in executing statement: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if (!$result) {
            die('Error in getting result set: ' . $stmt->error);
        }

        $goal = $result->fetch_assoc();

        $stmt->close();

        return $goal;
    }

    public function editGoal($data)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $this->sessionStart();

        if ($user_id === null) {
            return [
                'success' => false,
                'message' => 'User not logged in',
            ];
        }

        $stmt = $this->conn->prepare(
            "UPDATE $this->table_name SET
                name = ?,
                target_amount = ?,
                target_date = ?,
                risk_tolerance = ?
            WHERE id = ?"
        );

        if ($stmt === false) {
            return [
                'success' => false,
                'message' => 'Failed to prepare statement',
            ];
        }

        $stmt->bind_param(
            "sissi",
            $data['name'],
            $data['target_amount'],
            $data['target_date'],
            $data['risk_tolerance'],
            $data['id']
        );

        $executed = $stmt->execute();

        if ($executed) {
            return [
                'success' => true,
                'message' => 'Goal updated successfully',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update goal',
            ];
        }
    }

    public function deleteGoal($id)
    {
        $sql = "DELETE FROM $this->table_name WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            throw new \Exception("Error preparing statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        if ($result === false) {
            throw new \Exception("Error executing statement: " . $stmt->error);
        }

        $stmt->close();

        header("Location: goal");

        return true;
    }

    public function search($data)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $this->sessionStart();

        $searchTerm = "%$data%";
        $sql = "SELECT * FROM $this->table_name WHERE name LIKE ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("si", $searchTerm, $user_id);
        $result = $stmt->execute();
        if ($result === false) {
            throw new \Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new \Exception("Get result failed: " . $stmt->error);
        }

        $goals = [];
        while ($row = $result->fetch_assoc()) {
            $goals[] = $row;
        }

        $stmt->close();
        return $goals;
    }

    public function getBudgetName()
    {
        $user_id = $this->sessionStart();

        $sql = "SELECT id, name FROM budgets WHERE user_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new \Exception("Get result failed: " . $stmt->error);
        }

        $getBudgetName = [];
        while ($row = $result->fetch_assoc()) {
            $getBudgetName[] = $row;
        }

        $stmt->close();

        return $getBudgetName;

    }

    public function sessionStart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        return $user_id;
    }
}
