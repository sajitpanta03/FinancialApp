<?php
// namespace config\Database;

class Database 
{
    // Connection details
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "FinancialApp";
    public $conn;

    public function dbConnection()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->conn = new \mysqli($this->hostname, $this->username, $this->password, $this->databaseName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            return $this->conn;
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }
}
?>
