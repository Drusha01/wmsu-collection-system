<?php

namespace App\Livewire\Csc\Paymentrecords;

use Livewire\Component;

class Paymentrecords extends Component
{
    public $title = "PaymentRecords";
    public function render()
    {
        return view('livewire.csc.paymentrecords.paymentrecords')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
