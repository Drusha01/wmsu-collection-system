<?php

namespace App\Livewire\Admin\AuditLogs;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuditLogs extends Component
{
    public $title = "Audit Logs";
    public function render()
    {
        return view('livewire.admin.audit-logs.audit-logs') 
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
