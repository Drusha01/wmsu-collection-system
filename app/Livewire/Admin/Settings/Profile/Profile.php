<?php

namespace App\Livewire\Admin\Settings\Profile;

use Livewire\Component;

class Profile extends Component
{

    public $title = "Profile";
    public function render()
    {
        return view('livewire.admin.settings.profile.profile')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);

    }
}
