<?php

namespace App\Livewire\Admin\SystemLogs;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SystemLogs extends Component
{
    public $title = "System Logs";
    public function render()
    {
        return view('livewire.admin.system-logs.system-logs')
            ->layout('components.layouts.admin',[
                'title'=>$this->title]);
    }
}
