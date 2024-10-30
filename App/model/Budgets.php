<?php

namespace App\model;

class Budgets
{
    private $conn;
    private $table_name = "budgets";

    public function __construct()
    {
        $this->conn = new \Database();
        $this->conn = $this->conn->dbConnection();
    }

    public function getAllBudgets()
    {
        $user_id = $this->sessionStart();

        $sql = "SELECT * FROM $this->table_name WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        $budgets = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $budgets[] = $row;
            }
        }
        return $budgets;
    }

    public function getUserBudgetsTotal()
    {
        $user_id = $this->sessionStart();

        if (!$user_id) {
            return 0;
        }

        $sql = "SELECT SUM(total_amount) as total FROM $this->table_name WHERE user_id = ?";
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

    public function storeBudget($data)
    {
        $user_id = $this->sessionStart();

        $sql = "INSERT INTO $this->table_name (name, total_amount, start_date, end_date, user_id) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception($this->conn->error);
        }

        $stmt->bind_param(
            'sdssi',
            $data['name'],
            $data['total_amount'],
            $data['start_date'],
            $data['end_date'],
            $user_id
        );

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getBudgetById($id)
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

        $budget = $result->fetch_assoc();

        $stmt->close();

        return $budget;
    }

    public function editBudget($data)
    {
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
            total_amount = ?,
            start_date = ?,
            end_date = ?
        WHERE id = ? AND user_id = ?"
        );

        if ($stmt === false) {
            return [
                'success' => false,
                'message' => 'Failed to prepare statement: ' . $this->conn->error,
            ];
        }

        $stmt->bind_param(
            "sdssii",
            $data['name'],
            $data['total_amount'],
            $data['start_date'],
            $data['end_date'],
            $data['id'],
            $user_id
        );

        $executed = $stmt->execute();

        if ($executed) {
            $stmt->close();
            return [
                'success' => true,
                'message' => 'Budget updated successfully',
            ];
        } else {
            $stmt->close();
            return [
                'success' => false,
                'message' => 'Failed to update Budget: ' . $stmt->error,
            ];
        }
    }

    public function deleteBudget($id)
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

        header("Location: budget");

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

        $budget = [];
        while ($row = $result->fetch_assoc()) {
            $budget[] = $row;
        }

        $stmt->close();
        return $budget;
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
