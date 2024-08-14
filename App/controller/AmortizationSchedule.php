<?php
namespace App\controller;

class AmortizationSchedule
{
    protected $principal;
    protected $annualRate;
    protected $termsInYears;

    public function __construct($principal, $annualRate, $termsInYears)
    {
        $this->principal = $principal;
        $this->annualRate = $annualRate;
        $this->termsInYears = $termsInYears;
    }

    public function amortizationResult()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate user inputs
            $principal = filter_input(INPUT_POST, 'principal', FILTER_VALIDATE_FLOAT);
            $annualRate = filter_input(INPUT_POST, 'annual_rate', FILTER_VALIDATE_FLOAT);
            $termsInYears = filter_input(INPUT_POST, 'terms_in_years', FILTER_VALIDATE_INT);
    
            // Check if inputs are valid
            if ($principal === false || $annualRate === false || $termsInYears === false || $principal <= 0 || $annualRate <= 0 || $termsInYears <= 0) {
                // Handle invalid inputs
                echo 'Invalid input. Please check your values.';
                return;
            }
    
            // Instantiate the AmortizationSchedule class
            $schedule = new AmortizationSchedule($principal, $annualRate, $termsInYears);
    
            // Generate the amortization schedule
            $scheduleData = $schedule->generateSchedule();
    
            // Pass the data to the view
            return view('/Calculation/amortizationSchedule', ['scheduleData' => $scheduleData]);
        } else {
            // Handle GET requests or other methods
            echo 'Invalid request method. Please use POST to submit the form.';
        }
    }
    

    public function generateSchedule()
    {
        $schedule = [];
        $monthlyRate = $this->annualRate / 12 / 100;
        $numberOfPayments = $this->termsInYears * 12;
        $monthlyPayment = $this->principal * $monthlyRate / (1 - pow(1 + $monthlyRate, -$numberOfPayments));
        $balance = $this->principal;

        for ($i = 1; $i <= $numberOfPayments; $i++) {
            $interestPayment = $balance * $monthlyRate;
            $principalPayment = $monthlyPayment - $interestPayment;
            $balance -= $principalPayment;

            $schedule[] = [
                'Payment Number' => $i,
                'Principal Payment' => number_format($principalPayment, 2),
                'Interest Payment' => number_format($interestPayment, 2),
                'Total Payment' => number_format($monthlyPayment, 2),
                'Balance' => number_format(max($balance, 0), 2),
            ];
        }

        return $schedule;
    }
}

?>
