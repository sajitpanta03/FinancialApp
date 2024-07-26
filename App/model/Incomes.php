<?php

namespace App\model;

class Incomes
{
    private $conn;
    private $table_name = "incomes";

    public function __construct()
    {
        $this->conn = new \Database();
        $this->conn = $this->conn->dbConnection();
    }

    public function getAllIncomes()
    {
        $user_id = $this->sessionStart();

        $sql = "SELECT * FROM $this->table_name WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        $incomes = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $incomes[] = $row;
            }
        }
        return $incomes;
    }

    public function storeIncome($data)
    {
        $user_id = $this->sessionStart();

        $sql = "INSERT INTO $this->table_name (name, amount, type, user_id) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception($this->conn->error);
        }

        $stmt->bind_param(
            'sdsi',
            $data['name'],
            $data['amount'],
            $data['type'],
            $user_id
        );

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getIncomeById($id)
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

        $income = $result->fetch_assoc();

        $stmt->close();

        return $income;
    }

    public function editIncome($data)
{
    $user_id = $this->sessionStart();

    if ($user_id === null) {
        return [
            'success' => false,
            'message' => 'User not logged in'
        ];
    }

    $stmt = $this->conn->prepare(
        "UPDATE $this->table_name SET 
            name = ?, 
            amount = ?, 
            type = ? 
        WHERE id = ? AND user_id = ?"
    );

    if ($stmt === false) {
        return [
            'success' => false,
            'message' => 'Failed to prepare statement: ' . $this->conn->error
        ];
    }

    $stmt->bind_param(
        "sdsii",
        $data['name'],
        $data['amount'],
        $data['type'],
        $data['id'],
        $user_id
    );

    $executed = $stmt->execute();

    if ($executed) {
        $stmt->close();
        return [
            'success' => true,
            'message' => 'Income updated successfully'
        ];
    } else {
        $stmt->close();
        return [
            'success' => false,
            'message' => 'Failed to update income: ' . $stmt->error
        ];
    }
}


    public function deleteIncome($id)
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

        header("Location: income");

        return true;
    }

    public function sessionStart()
    {
        session_start();
        $user_id = $_SESSION['user_id'] ?? null;
        return $user_id;
    }
}
