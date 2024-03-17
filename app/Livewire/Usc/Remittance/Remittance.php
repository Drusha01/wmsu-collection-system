<?php

namespace App\Livewire\Usc\Remittance;

use Livewire\Component;

class Remittance extends Component
{
    public $title = "Remittance";
    public function render()
    {
        return view('livewire.usc.remittance.remittance')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
