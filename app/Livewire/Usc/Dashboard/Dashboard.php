<?php

namespace App\Livewire\Usc\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = "Fees";
    public function render()
    {
        return view('livewire.usc.dashboard.dashboard')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
