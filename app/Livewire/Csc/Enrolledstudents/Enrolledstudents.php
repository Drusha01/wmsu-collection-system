<?php

namespace App\Livewire\Csc\Enrolledstudents;

use Livewire\Component;

class Enrolledstudents extends Component
{
    public $title = "Enrolledstudents";
    public function render()
    {
        return view('livewire.csc.enrolledstudents.enrolledstudents')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
