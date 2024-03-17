<?php

namespace App\Livewire\Csc\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = "Dashboard";
    public function render()
    {
        return view('livewire.csc.dashboard.dashboard')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
