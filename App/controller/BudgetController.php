<?php
namespace App\controller;

use App\model\Budgets;

class BudgetController {

  public $users;

  public function __construct()
  {
  	$hello = $this->users = new Budgets();
    print_r($hello);
  }

  public function showBudget()
  {
    return view('/UserDashboard/userPageBudget');
  }
}
?>
