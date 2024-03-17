<?php

namespace App\Livewire\Usc\Remitrecords;

use Livewire\Component;

class Remitrecords extends Component
{
    public $title = "RemitRecords";
    public function render()
    {
        return view('livewire.usc.remitrecords.remitrecords')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
