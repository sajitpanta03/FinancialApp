<?php
namespace App\model;

use config\Database;

class Users 
{
    public $conn;
    public $table_name = "users";
    public $fillable = ['name', 'email', 'password'];

    public function __construct()
    {
        $database = new \Database();
        $this->conn = $database->dbConnection();
    }
}
?>
