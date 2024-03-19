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
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'college_id' => NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
    ];
    public $colleges_data = [];
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
    public function render()
    {
        if($this->prevstudent_id_search != $this->student_id_search){
            $this->prevstudent_id_search = $this->student_id_search;
            $this->resetPage();
        }
        if($this->filters['college_id'] != $this->filters['prevcollege_id']){
            $this->filters['prevcollege_id'] = $this->filters['college_id'];
            $this->resetPage();
        }
      
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
            ->where('s.college_id','like',$this->filters['college_id'].'%')
            ->where('s.student_code','like',$this->student_id_search.'%')
            ->paginate(10);
        
    
        $this->colleges_data = DB::table('colleges')
            ->get()
            ->toArray();

        return view('livewire.csc.students.students',
            ['student_data'=>$student_data ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    
}
