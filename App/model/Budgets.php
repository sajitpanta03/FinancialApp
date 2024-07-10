<?php 

namespace App\model;

class Budgets 
{
    public $conn;
    private $table_name = "budgets";
    // protected $fillable = ['name', 'email', 'password'];

    public function __construct()
    {
        $database = new \Database();
        $this->conn = $database->dbConnection();
    }
}