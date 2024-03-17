<?php

namespace App\Livewire\Csc\Fees;

use Livewire\Component;

class Fees extends Component
{
    public $title = "Fees";
    public function render()
    {
        return view('livewire.csc.fees.fees')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
