<?php

namespace App\Livewire\Admin\Settings\Fees;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Fees extends Component
{
    public $title = "Fees";
    public function render()
    {
        return view('livewire.admin.settings.fees.fees')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
