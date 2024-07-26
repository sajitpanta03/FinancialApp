<?php
namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;

class UserAuthController {

  public $users;

  public function __construct()
  {
    $this->users = new Users();
  }

  public function showRegister()
  {
    return view('/Auth/register');
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $c_password = $_POST['c_password'];

      if ($password != $c_password) {
          echo "password and confirm password should be same";
          exit();
      }

      try {
        $registered = $this->users->register($name, $email, $password);

        if ($registered) {
          echo 'User registered successfully!';
        } else {
          echo 'Registration failed.';
        }
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    } else {
      http_response_code(405);
      echo 'Method not allowed';
    }
  }

  public function showLogin()
  {
    return view('/Auth/login');
  }

  public function login()
  {
    session_start();
    $_SESSION['user_id'] = $user_id;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      try {
        $user = $this->users->login($email, $password);

        if ($user) {
          session_start();
          session_regenerate_id(true);

          $_SESSION['user_id'] = $user['id'];
          $_SESSION['user_email'] = $user['email'];
          $_SESSION['logged_in'] = true;

          header("Location: /FinancialApp/dashboard");
          exit;
        } else {
          echo 'Invalid email or password.';
        }
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    } else {
      http_response_code(405);
      echo 'Method not allowed';
    }
  }

  public function logout()
  {
    session_start();
    $_SESSION = [];
    session_destroy();
    header("Location: FinancialApp");
    exit;
  }
}
?>
