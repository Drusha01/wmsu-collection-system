<?php

namespace App\Livewire\Admin\Settings\Overview;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Overview extends Component
{
    public $title = "Overview";
    public function render()
    {
        return view('livewire.admin.settings.overview.overview')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
