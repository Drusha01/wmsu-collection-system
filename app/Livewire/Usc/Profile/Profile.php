<?php

namespace App\Livewire\Usc\Profile;

use Livewire\Component;

class Profile extends Component
{

    public $title = "Profile";
    public function render()
    {
        return view('livewire.usc.profile.profile')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
