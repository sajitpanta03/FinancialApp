<?php
namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;

class UserAuthController {
  private $users;

  public function __construct()
  {
  	$user = new Users();
  }

  public function showRegister()
  {
    return view('/Auth/register');
  }

  // public function register()
  // {
      
  // }

    // public function register()
    // {
    //     header('Content-Type: application/json');

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $name = $_POST['name'];
    //         $email = $_POST['email'];
    //         $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    //         try {
    //             $stmt = $this->user->prepare("INSERT INTO users (name, email, password) VALUES (:username, :email, :password)");
    //             $stmt->bindParam(':username', $username);
    //             $stmt->bindParam(':password', $password);
    //             $stmt->execute();

      
    //             echo json_encode(['success' => true, 'message' => 'User registered successfully']);
    //         } catch (Exception $e) {
        
    //             echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    //         }
    //     } else {
    //         echo json_encode(['error' => 'Method not allowed']);
    //     }
    // }

  public function register()
  {
    return echo json_encode("hello");
  }
}
?>
