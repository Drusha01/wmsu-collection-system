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
        $payment_records_data = DB::table('payment_items as pi')
            ->select(
                "pi.id as id",
                "u.id as user_id",
                "u.first_name as collector_first_name",
                "u.middle_name as collector_middle_name",
                "u.last_name as collector_last_name",
                "u.username as collector_username",
                "s.id as student_id",
                "s.student_code as student_code",
                "s.first_name as student_first_name",
                "s.middle_name as student_middle_name",
                "s.last_name as student_last_name",
                "f.name as fee_name",
                "f.code as fee_code",
                "ft.name as fee_type_name",
                "pi.amount",
                'pi.date_created as date_created'
            )
            ->join('students as s','s.id','pi.student_id')
            ->join('enrolled_students as es','s.id','es.student_id')
            ->join('users as u','u.id','pi.collected_by')
            ->join('fees as f','f.id','pi.fee_id')
            ->rightjoin('fee_types as ft','ft.id','f.fee_type_id')
            ->where('es.college_id','<>',0)
            ->orderBy('pi.date_created','desc')
            ->groupBy('pi.id')
            ->paginate(10);
        return view('livewire.admin.payment-records.payment-records',[
            'payment_records_data'=>$payment_records_data
        ]) 
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
