<?php

namespace App\Livewire\Csc\Students;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;

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
        'search'=> NULL,
        'search_by' => 'Student code',
        'prev_search'=> NULL,
    ];
    public $colleges_data = [];
    public $departments;
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Student email',
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
    public function boot(Request $request ){

        $session = $request->session()->all();
        $user_id = $session['id'];
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name',
                'p.name as position_name',
                'u.is_active',
                'u.college_id',
                'u.school_year_id',
                'c.name as college_name',
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as schoo_year')
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->leftjoin('positions as p','p.id','u.position_id')
            ->join('colleges as c','c.id','u.college_id')
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first()){
            $this->user_details = $user_details;
            
          
        }else{
            return redirect()->route('login');
        }
    }
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] = $this->filters['search'];
            $this->resetPage();
        }
        if($this->filters['department_id'] != $this->filters['prevdepartment_id']){
            $this->filters['prevdepartment_id'] = $this->filters['department_id'];
            $this->resetPage();
        }
      
        if($this->filters['search_by'] == 'Student code' ){
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
            ->where('s.department_id','like',$this->filters['department_id'].'%')
            ->where('s.student_code','like',$this->filters['search'].'%')
            ->where('s.college_id','=',$this->user_details->college_id)
            ->orderBy('id','desc')
            ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student name'){
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
            ->where('s.department_id','like',$this->filters['department_id'].'%')
            ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
            ->where('s.college_id','=',$this->user_details->college_id)
            ->orderBy('id','desc')
            ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student email'){
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
            ->where('s.department_id','like',$this->filters['department_id'].'%')
            ->where('s.email','like',$this->filters['search'].'%')
            ->where('s.college_id','=',$this->user_details->college_id)
            ->orderBy('id','desc')
            ->paginate(10);
        }
       
        
    
        $this->departments = DB::table('departments')
            ->where('college_id','=',$this->user_details->college_id)
            ->get()
            ->toArray();
            
        $page_info = DB::table('users as u')
            ->select(
                'c.name as college_name',
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
            )
            ->where('u.id','=',$this->user_details->id)
            ->join('colleges as c','c.id','u.college_id')
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first();

        return view('livewire.csc.students.students',[
            'student_data'=>$student_data,
            'page_info'=>$page_info
             ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
   
    
}
