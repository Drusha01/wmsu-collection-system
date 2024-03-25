<?php

namespace App\Livewire\Admin\RemitRecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class RemitRecords extends Component
{
    use WithPagination;
    public $title = "Remittance";
    public $school_years;
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'school_year_id'=> NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'username'=> NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'prev_school_year_id'=> NULL,
        'prev_username'=> NULL,
        
    ];
    public function mount(){
        $this->school_years = DB::table('school_years')
        ->orderBy('id','desc')
        ->get()
        ->toArray();
    }
    public function render()
    {
        if($this->filters['school_year_id'] != $this->filters['prev_school_year_id']){
            $this->filters['prev_school_year_id'] =$this->filters['school_year_id'];
            $this->resetPage();
        }
        if($this->filters['username'] != $this->filters['prev_username']){
            $this->filters['prev_username'] =$this->filters['username'];
            $this->resetPage();
        }
        
        $remittance_data = DB::table('remits as r')
            ->select(
                'r.id',
                'u.username as approved_by_username',
                'u.first_name as approved_by_first_name',
                'u.middle_name as approved_by_middle_name',
                'u.last_name as approved_by_last_name',
                'rbyu.username as remitted_by_username',
                'rbyu.first_name as remitted_by_first_name',
                'rbyu.middle_name as remitted_by_middle_name',
                'rbyu.last_name as remitted_by_last_name',
                'r.remitted_date',
                'r.approved_date' ,
                'r.remit_photo',
                'r.amount',
                'sy.year_start',
                'sy.year_end',
                's.semester',
                'r.appoved_by',
                'c.name as college_name'
            )
            ->join('users as rbyu','rbyu.id','r.remitted_by')
            ->leftjoin('colleges as c','c.id','rbyu.college_id')
            ->join('school_years as sy','sy.id','r.school_year_id')
            ->join('semesters as s','s.id','r.semester_id')
            ->leftjoin('users as u','u.id','r.appoved_by')
            ->where('r.school_year_id','like',$this->filters['school_year_id'].'%')
            ->where('rbyu.username','like',$this->filters['username'].'%')
            ->orderby('r.date_created','desc')
            ->paginate(10);
        return view('livewire.admin.remit-records.remit-records',[
            'remittance_data'=>$remittance_data
        ])
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
