<?php

namespace App\Livewire\Admin\Students;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Students extends Component
{
    public $title = "Students";
    public function render()
    {
        return view('livewire.admin.students.students')
            ->layout('components.layouts.admin',[
                'title'=>$this->title]);
    }
}
