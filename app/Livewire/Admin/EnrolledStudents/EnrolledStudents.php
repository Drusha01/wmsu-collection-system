<?php

namespace App\Livewire\Admin\EnrolledStudents;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EnrolledStudents extends Component
{
    public $title = "Enrolled Students";
    public function render()
    {
        return view('livewire.admin.enrolled-students.enrolled-students')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
