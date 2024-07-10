<?php
// namespace config\Database;

class Database 
{
    // Connection details
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "FinancialApp";

    public function dbConnection()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $conn = new \mysqli($this->hostname, $this->username, $this->password, $this->databaseName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
}
?>
