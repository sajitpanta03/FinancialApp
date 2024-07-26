<?php
namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;

class UserController {

  public $users;

  public function __construct()
  {
  	$this->users = new Users();
  }

  public function showDashboard()
  {
    return view('/UserDashboard/userPageDashboard');
  }
}
?>
