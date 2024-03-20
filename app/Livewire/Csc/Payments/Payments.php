<?php

namespace App\Livewire\Csc\Payments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;
    public $title = "Payments";
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
    ];
    public $semesters;
    public $colleges_data;
    public $department_data;
    public $year_levels;
    public $student_id_search;
    public $prevstudent_id_search;
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
                'is_active',
                'u.college_id',
                'u.school_year_id'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->leftjoin('positions as p','p.id','u.position_id')
            ->get()
            ->first()){
            $this->user_details = $user_details;
            
          
        }else{
            return redirect()->route('login');
        }
    }
    public function render()
    {
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $this->colleges_data = DB::table('colleges')
            ->where('id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
        $this->department_data = DB::table('departments')
            ->where('college_id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();

            $enrolled_students_data = DB::table('students as s')
            ->select(
                "s.id",
                "s.student_code",
                "s.first_name",
                "s.middle_name",
                "s.last_name",
                "s.email",
            )
            ->rightjoin('enrolled_students as es','es.student_id','s.id')
            ->where('es.college_id','=', $this->user_details->college_id)
            ->groupBy('s.id')
            ->paginate(10);
        // $enrolled_students_data = DB::table('enrolled_students as es')
        //     ->select(
        //         "s.student_code",
        //         "s.first_name",
        //         "s.middle_name",
        //         "s.last_name",
        //         "s.email",
        //         "es.college_id",
        //         "es.department_id",
        //         "c.code as college_code",
        //         "c.name as college_name",
        //         "d.name as department_name",
        //         "d.code as department_code",
        //         's.is_muslim',
        //         's.is_active',
        //         'sm.semester',
        //         'sy.year_start',
        //         'sy.year_end',
        //         'yl.year_level'
        //     )
        //     ->join('students as s','es.student_id','s.id')
        //     ->join('colleges as c','es.college_id','c.id')
        //     ->join('departments as d','es.department_id','d.id')
        //     ->join('semesters as sm','es.semester_id','sm.id')
        //     ->join('school_years as sy','es.school_year_id','sy.id')
        //     ->join('year_levels as yl','es.year_level_id','yl.id')
        //     ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
        //     ->where('es.department_id','like',$this->filters['department_id'].'%')
        //     ->where('es.semester_id','like',$this->filters['semester_id'].'%')
        //     ->where('s.student_code','like',$this->student_id_search.'%')
        //     ->groupBy('es.student_id')
        //     ->paginate(10);
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
        return view('livewire.csc.payments.payments',[
            'enrolled_students_data'=>$enrolled_students_data,
            'page_info'=>$page_info
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
