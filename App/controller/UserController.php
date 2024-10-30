<?php
namespace App\controller;

require_once __DIR__ . '/../model/Users.php';

use App\model\Users;
use App\model\Goals;
use App\model\Incomes;
use App\model\Budgets;

class UserController {

  public $users;
  public $goals;
  public $incomes;
  public $budgets;


  public function __construct()
  {
  	$this->users = new Users();
    $this->goals = new Goals();
    $this->incomes = new Incomes();
    $this->budgets =  new Budgets();
  }

  public function showDashboard()
  {
    $getUserGoalsTotal = $this->goals->getUserGoalsTotal();
    $getUserIncomesTotal = $this->incomes->getUserIncomesTotal();
    $getUserBudgetsTotal = $this->budgets->getUserBudgetsTotal();

    return view('/UserDashboard/userPageDashboard', ["getUserGoalsTotal" => $getUserGoalsTotal, "getUserIncomesTotal" => $getUserIncomesTotal, 'getUserBudgetsTotal' => $getUserBudgetsTotal]);
  }

  
}
?>
