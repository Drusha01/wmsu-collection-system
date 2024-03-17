<?php

namespace App\Livewire\Csc\Auditlogs;

use Livewire\Component;

class Auditlogs extends Component
{
    public $title = "AuditLogs";
    public function render()
    {
        return view('livewire.csc.auditlogs.auditlogs')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
