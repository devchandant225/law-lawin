<?php

namespace App\Livewire;

use Livewire\Component;

class Calculator extends Component
{
    public $amount = '';
    public $lawFee = null;
    public $calculationBreakdown = [];
    public $showBreakdown = false;

    // Constants for calculation
    private $twentyfivethousand = 25000;
    private $fiftythousand = 50000;
    private $onelakh = 100000;
    private $fivelakh = 500000;
    private $twentyfivelakh = 2500000;

    public function updatedAmount()
    {
        $this->lawFee = null;
        $this->calculationBreakdown = [];
        $this->showBreakdown = false;
    }

    public function calculateLawFee()
    {
        $amountValue = floatval($this->amount);
        
        if ($amountValue <= 0) {
            session()->flash('error', 'Please enter a valid amount.');
            return;
        }

        $fee = 0;
        $breakdown = [];

        if ($amountValue <= $this->twentyfivethousand) {
            $fee = 500;
            $breakdown = [['range' => 'Upto 25,000', 'fee' => 500]];
        } elseif ($amountValue <= $this->fiftythousand) {
            $amt = $amountValue - $this->twentyfivethousand;
            $step1Fee = 500;
            $step2Fee = 0.05 * $amt;
            $fee = $step1Fee + $step2Fee;

            $breakdown = [
                ['range' => 'Upto 25,000', 'fee' => $step1Fee],
                ['range' => "From 25,001 to 50,000 : 5% of " . number_format($amt), 'fee' => $step2Fee],
            ];
        } elseif ($amountValue <= $this->onelakh) {
            $amt = $amountValue - $this->fiftythousand;
            $step1Fee = 500;
            $step2Fee = 0.05 * $this->twentyfivethousand;
            $step3Fee = 0.035 * $amt;
            $fee = $step1Fee + $step2Fee + $step3Fee;

            $breakdown = [
                ['range' => 'Upto 25,000', 'fee' => $step1Fee],
                ['range' => 'From 25,001 to 50,000 : 5% of 25,000', 'fee' => $step2Fee],
                ['range' => "From 50,001 to 1,00,000 : 3.5% of " . number_format($amt), 'fee' => $step3Fee],
            ];
        } elseif ($amountValue <= $this->fivelakh) {
            $amt = $amountValue - $this->onelakh;
            $step1Fee = 500;
            $step2Fee = 0.05 * $this->twentyfivethousand;
            $step3Fee = 0.035 * $this->fiftythousand;
            $step4Fee = 0.02 * $amt;
            $fee = $step1Fee + $step2Fee + $step3Fee + $step4Fee;

            $breakdown = [
                ['range' => 'Upto 25,000', 'fee' => $step1Fee],
                ['range' => "From 25,001 to 50,000 : 5% of " . number_format($this->twentyfivethousand), 'fee' => $step2Fee],
                ['range' => "From 50,001 to 1,00,000 : 3.5% of " . number_format($this->fiftythousand), 'fee' => $step3Fee],
                ['range' => "From 1,00,001 to 5,00,000 : 2% of " . number_format($amt), 'fee' => $step4Fee],
            ];
        } elseif ($amountValue <= $this->twentyfivelakh) {
            $amt = $amountValue - $this->fivelakh;
            $step1Fee = 500;
            $step2Fee = 0.05 * $this->twentyfivethousand;
            $step3Fee = 0.035 * $this->fiftythousand;
            $step4Fee = 0.02 * 400000;
            $step5Fee = 0.015 * $amt;
            $fee = $step1Fee + $step2Fee + $step3Fee + $step4Fee + $step5Fee;

            $breakdown = [
                ['range' => 'Upto 25,000', 'fee' => $step1Fee],
                ['range' => "From 25,001 to 50,000 : 5% of " . number_format($this->twentyfivethousand), 'fee' => $step2Fee],
                ['range' => "From 50,001 to 1,00,000 : 3.5% of " . number_format($this->fiftythousand), 'fee' => $step3Fee],
                ['range' => 'From 1,00,001 to 5,00,000 : 2% of 4,00,000', 'fee' => $step4Fee],
                ['range' => "From 5,00,001 to 25,00,000 : 1.5% of " . number_format($amt), 'fee' => $step5Fee],
            ];
        } else {
            $amt = $amountValue - $this->twentyfivelakh;
            $step1Fee = 500;
            $step2Fee = 0.05 * $this->twentyfivethousand;
            $step3Fee = 0.035 * $this->fiftythousand;
            $step4Fee = 0.02 * 400000;
            $step5Fee = 0.015 * 2000000;
            $step6Fee = 0.01 * $amt;
            $fee = $step1Fee + $step2Fee + $step3Fee + $step4Fee + $step5Fee + $step6Fee;

            $breakdown = [
                ['range' => 'Upto 25,000', 'fee' => $step1Fee],
                ['range' => "From 25,001 to 50,000 : 5% of " . number_format($this->twentyfivethousand), 'fee' => $step2Fee],
                ['range' => "From 50,001 to 1,00,000 : 3.5% of " . number_format($this->fiftythousand), 'fee' => $step3Fee],
                ['range' => 'From 1,00,001 to 5,00,000 : 2% of 4,00,000', 'fee' => $step4Fee],
                ['range' => 'From 5,00,001 to 25,00,000 : 1.5% of 20,00,000', 'fee' => $step5Fee],
                ['range' => "Above 25,00,001 : 1% of " . number_format($amt), 'fee' => $step6Fee],
            ];
        }

        $this->lawFee = $fee;
        $this->calculationBreakdown = $breakdown;
        $this->showBreakdown = true;
    }

    public function render()
    {
        return view('livewire.calculator');
    }
}
