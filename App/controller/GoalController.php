<?php 

namespace App\controller;

require_once __DIR__ . '/../model/Goals.php';

use App\model\Goals;

class GoalController
{
    public $goals;

    public function __construct()
    {
        $this->goals = new Goals();
    }

    public function showGoal()
    {
        return view('/UserDashboard/userPageGoal');
    }
}