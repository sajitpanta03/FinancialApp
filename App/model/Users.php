<?php
namespace App\model;

require_once __DIR__ . '/../../config/db.php'; //

use config\db\Database;

class Users 
{
    private $conn;
    public $fillable = ['name', 'email', 'password'];

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function hello()
    {
        return "Hello, the connection is: " . $this->conn->host_info;
    }
}


?>
