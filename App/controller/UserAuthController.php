<?php

namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;

class UserAuthController
{

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
      $type = 'user';

      if ($password != $c_password) {
        echo "password and confirm password should be same";
        exit();
      }

      try {
        $registered = $this->users->register($name, $email, $password, $type);

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $type = $_POST['type'] ?? 'user';

      try {
        $user = $this->users->login($email, $password, $type);
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
