<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/App/model/Users.php';

use config\db\Database;
use App\model\Users;

// Create an instance of the Database class and establish a connection
$db = new Database();
$conn = $db->dbConnection();

// Pass the connection to the Users class
$users = new Users($conn);

// Call the hello method
echo $users->hello();
?>
