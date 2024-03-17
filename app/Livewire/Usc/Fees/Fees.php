<?php

namespace App\Livewire\Usc\Fees;

use Livewire\Component;

class Fees extends Component
{
    public $title = "Fees";
    public function render()
    {
        return view('livewire.usc.fees.fees')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
