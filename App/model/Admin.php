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
    
}