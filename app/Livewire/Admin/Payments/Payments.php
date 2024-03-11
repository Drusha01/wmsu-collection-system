<?php

namespace App\Livewire\Admin\Payments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Payments extends Component
{
    public $title = "Payments";
    public function render()
    {
        return view('livewire.admin.payments.payments')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
