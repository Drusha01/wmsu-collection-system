<?php

namespace App\Livewire\Authentication;

use Livewire\Component;

class TermEnded extends Component
{
    public $title ="Term Ended";
    public function render()
    {
        return view('livewire.authentication.term-ended')
        ->layout('components.layouts.guest',[
            'title'=>$this->title]);
    }
}
