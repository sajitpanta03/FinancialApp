<?php

namespace App\controller;

use App\controller\MonteCarloSimulationController;

class AnalyticController
{
    public function showAnalytic()
    {
        $simulationResults = new MonteCarloSimulationController();
        return view('/UserDashboard/userPageAnalytic', ['simulationResults' => $simulationResults]);
    }
}
