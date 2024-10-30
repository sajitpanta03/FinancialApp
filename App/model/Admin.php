<?php 

namespace App\model;

class Admin 
{
    private $conn;
    private $table_name = "users";

    public function __construct()
    {
        $this->conn = new \Database();
        $this->conn = $this->conn->dbConnection();
    }

    public function totalUser()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table_name";
        
        $result = $this->conn->query($sql);
    
        $row = $result->fetch_assoc();
        
        return $row['total'];
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($sql);

        $users = [];

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function search($data)
    {
        $searchTerm = "%$data%";
        $sql = "SELECT * FROM $this->table_name WHERE name LIKE ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new \Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $searchTerm);
        $result = $stmt->execute();
        if ($result === false) {
            throw new \Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new \Exception("Get result failed: " . $stmt->error);
        }

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        $stmt->close();
        return $users;
    }

    public function deleteUser($id)
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

        header("Location: adminUser");

        return true;
    }
    
}