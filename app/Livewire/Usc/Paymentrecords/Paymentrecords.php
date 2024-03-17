<?php

namespace App\Livewire\Usc\Paymentrecords;

use Livewire\Component;

class Paymentrecords extends Component
{
    public $title = "PaymentRecords";
    public function render()
    {
        return view('livewire.usc.paymentrecords.paymentrecords')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
