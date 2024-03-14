<?php

namespace App\Livewire\Authentication;

use Livewire\Component;

class DisabledAccount extends Component
{
    public $title ="Disabled";
    public function render()
    {
        return view('livewire.authentication.disabled-account') 
        ->layout('components.layouts.guest',[
            'title'=>$this->title]);
    }
}
