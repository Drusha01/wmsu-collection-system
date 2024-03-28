<?php

namespace App\Livewire\Csc\Profile;

use Livewire\Component;

class Profile extends Component
{

    public $title ="Profile";
    public function render()
    {
        return view('livewire.csc.profile.profile')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
