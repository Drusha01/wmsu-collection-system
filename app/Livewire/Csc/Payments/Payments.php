<?php

namespace App\Livewire\Csc\Payments;

use Livewire\Component;

class Payments extends Component
{
    public $title = "Payments";
    public function render()
    {
        return view('livewire.csc.payments.payments')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
