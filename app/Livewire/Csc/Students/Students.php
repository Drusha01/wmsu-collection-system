<?php

namespace App\Livewire\Csc\Students;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;
    public $title = 'CSC - Student';
    public $student_id_search;
    public $prevstudent_id_search;
    public function render()
    {
        if($this->prevstudent_id_search != $this->student_id_search){
            $this->resetPage();
            $this->prevstudent_id_search = $this->student_id_search;
        }
        if(strlen($this->student_id_search)>0){
            $student_data = DB::table('students as s')
                ->select(
                    "s.id",
                    "student_code",
                    "first_name",
                    "middle_name",
                    "last_name",
                    "email",
                    "s.college_id",
                    "s.department_id",
                    "s.date_created",
                    "s.date_updated",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    's.is_muslim',
                    's.is_active'
                )
                ->join('colleges as c','s.college_id','c.id')
                ->join('departments as d','s.department_id','d.id')
                ->where('s.student_code','like',$this->student_id_search.'%')
                ->paginate(10);
        }
        else{
            $student_data = DB::table('students as s')
                ->select(
                    "s.id",
                    "student_code",
                    "first_name",
                    "middle_name",
                    "last_name",
                    "email",
                    "s.college_id",
                    "s.department_id",
                    "s.date_created",
                    "s.date_updated",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    's.is_muslim',
                    's.is_active'
                )
                ->join('colleges as c','s.college_id','c.id')
                ->join('departments as d','s.department_id','d.id')
                ->paginate(10);
        }
        $colleges_data = DB::table('colleges')
            ->get()
            ->toArray();

        return view('livewire.csc.students.students',
            ['student_data'=>$student_data,
            'colleges_data'=>$colleges_data  ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    
}
