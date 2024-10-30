<?php 

namespace App\controller;

class CalculationController 
{
    public function showCalculation()
    {
        return view('/UserDashboard/userPageCalculation');
    }

    public function AmortizationSchedule()
    {
        return view('/Calculation/amortizationSchedule');
    }
}