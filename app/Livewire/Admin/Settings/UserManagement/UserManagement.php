<?php

namespace App\Livewire\Admin\Settings\UserManagement;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserManagement extends Component
{
    public $title = "User Management";
    public function render()
    {
        return view('livewire.admin.settings.user-management.user-management')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
