<?php

namespace App\Livewire\Admin\Colleges;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Colleges extends Component
{
    public $title = "Colleges";
    public function render()
    {
        return view('livewire.admin.colleges.colleges')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
