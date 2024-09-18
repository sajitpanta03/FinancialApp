<?php

namespace App\controller;

class LoanCalculator
{
    private $amount;
    private $rate;
    private $term;
    private $frequency;

    public function __construct($amount, $rate, $term, $frequency)
    {
        $this->amount = $amount;
        $this->rate = $rate;
        $this->term = $term;
        $this->frequency = $frequency;
    }

    private function calculatePeriodRate()
    {
        return ($this->rate / 100) / $this->frequency;
    }

    private function calculateTotalPayments()
    {
        return $this->term * $this->frequency;
    }

    public function calculatePayment()
    {
        $periodRate = $this->calculatePeriodRate();
        $totalPayments = $this->calculateTotalPayments();
        return $this->amount * $periodRate / (1 - pow(1 + $periodRate, -$totalPayments));
    }

    public function generateAmortizationSchedule()
    {
        $schedule = [];
        $balance = $this->amount;
        $periodRate = $this->calculatePeriodRate();
        $payment = $this->calculatePayment();
        $totalPayments = $this->calculateTotalPayments();

        for ($i = 1; $i <= $totalPayments; $i++) {
            $interest = $balance * $periodRate;
            $principal = $payment - $interest;
            $balance -= $principal;

            $schedule[] = [
                'payment_number' => $i,
                'principal' => $principal,
                'interest' => $interest,
                'balance' => max($balance, 0)
            ];
        }

        return $schedule;
    }
}
?>
