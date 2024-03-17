<?php

namespace App\Livewire\Csc\Remitrecords;

use Livewire\Component;

class Remitrecords extends Component
{
    public $title = "RemitRecords";
    public function render()
    {
        return view('livewire.csc.remitrecords.remitrecords')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
