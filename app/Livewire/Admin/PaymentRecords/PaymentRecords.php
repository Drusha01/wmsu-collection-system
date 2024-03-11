<?php

namespace App\Livewire\Admin\PaymentRecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentRecords extends Component
{
    public $title = "Payments";
    public function render()
    {
        return view('livewire.admin.payment-records.payment-records') 
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
