<?php

namespace App\Livewire\Admin\RemitRecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemitRecords extends Component
{
    public $title = "Remittance";
    public function render()
    {
        return view('livewire.admin.remit-records.remit-records')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
