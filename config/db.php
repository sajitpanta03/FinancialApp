<?php
namespace config\db;

class Database 
{
    // Connection details
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "FinancialApp";

    public function dbConnection()
    {
        // Use global namespace for mysqli class
        $conn = new \mysqli($this->hostname, $this->username, $this->password, $this->databaseName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
}
?>
