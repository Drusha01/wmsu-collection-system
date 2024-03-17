<?php

namespace App\Livewire\Csc\Remittance;

use Livewire\Component;

class Remittance extends Component
{
    public $title = "Remittance";
    public function render()
    {
        return view('livewire.csc.remittance.remittance')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
