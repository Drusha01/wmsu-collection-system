<?php

namespace App\Livewire\Admin\Settings\Fees;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Fees extends Component
{
    public $title = "Fees";
    public $term = [];

    public $user_details;
    public $fee = [
        'id' => NULL,
        'name' => NULL, 
        'code' => NULL,
        'fee_type_id' => NULL,
        'amount' => NULL,
        'school_year_id' => NULL,
        'semester_id' => NULL,
        'created_by' => NULL,
        'for_muslim' => NULL,
    ];
    public $months = [
        0=>['month_name'=> 'January','month_number'=>1,'max_date'=>31],
        1=>['month_name'=> 'February','month_number'=>2,'max_date'=>28],
        2=>['month_name'=> 'March','month_number'=>3,'max_date'=>31],
        3=>['month_name'=> 'April','month_number'=>4,'max_date'=>30],
        4=>['month_name'=> 'May','month_number'=>5,'max_date'=>31],
        5=>['month_name'=> 'June','month_number'=>6,'max_date'=>30],
        6=>['month_name'=> 'July','month_number'=>7,'max_date'=>31],
        7=>['month_name'=> 'August','month_number'=>8,'max_date'=>31],
        8=>['month_name'=> 'September','month_number'=>9,'max_date'=>30],
        9=>['month_name'=> 'October','month_number'=>10,'max_date'=>31],
        10=>['month_name'=> 'Novermber','month_number'=>11,'max_date'=>30],
        11=>['month_name'=> 'December','month_number'=>12,'max_date'=>31],

    ];
    public $school_years = [];
    public $semesters = [];
    public $school_year = 0;
    public function render()
    {
        $this->school_years = DB::table('school_years')
            ->orderBy('id','desc')
            ->get()
            ->toArray();
        $this->school_year = NULL;
       
   
        $fees_data = DB::table('fees as f')
            ->select(
                'f.id',
                'f.name',
                'f.code',
                'f.amount',
                'f.name as fee_type_name',
                'sy.year_start',
                'sy.year_end',
                's.semester as semester',
                's.date_start_month',
                's.date_start_date',
                's.date_end_month',
                's.date_end_date',
                'u.first_name',
                'u.last_name',
                'u.middle_name',
                'u.id as user_id',
                'f.for_muslim',
                'u.id as user_id',
                'd.name as department_name'
            )
            ->join('fee_types as ft','ft.id','f.fee_type_id')
            ->join('users as u','u.id','f.created_by')
            ->join('school_years as sy','sy.id','f.school_year_id')
            ->join('semesters as s','s.id','f.semester_id')
            ->leftjoin('departments as d','d.id','f.department_id')
            ->where('f.school_year_id','like',$this->school_year.'%')
            ->paginate(10);

        return view('livewire.admin.settings.fees.fees',[
            'fees_data'=> $fees_data])
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
