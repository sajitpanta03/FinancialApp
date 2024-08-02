<?php
namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;
use App\model\Goals;
use App\model\Incomes;

class UserController {

  public $users;
  public $goals;
  public $incomes;

  public function __construct()
  {
  	$this->users = new Users();
    $this->goals = new Goals();
    $this->incomes = new Incomes();
  }

  public function showDashboard()
  {
    $getUserGoalsTotal = $this->goals->getUserGoalsTotal();
    $getUserIncomesTotal = $this->incomes->getUserIncomesTotal();

    return view('/UserDashboard/userPageDashboard', ["getUserGoalsTotal" => $getUserGoalsTotal, "getUserIncomesTotal" => $getUserIncomesTotal]);
  }

  
}
?>
