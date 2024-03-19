<?php

namespace App\Livewire\Csc\Payments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class StudentPayments extends Component
{
    use WithPagination;
    public $title = "Student Payments";
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
    ];
    public $student = [
            "id" => NULL,
            "student_code" => NULL,
            "first_name" => NULL,
            "middle_name" => NULL,
            "last_name" => NULL,
            "email" => NULL,
    ];
    public $student_id;
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
    public function mount(Request $request,$student_id){
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
        
        $this->student_id = $student_id;
        $student = DB::table('students as s')
        ->select(
            "s.id",
            "s.student_code",
            "s.first_name",
            "s.middle_name",
            "s.last_name",
            "s.email",
            "is_muslim"
        )
        ->rightjoin('enrolled_students as es','es.student_id','s.id')
        ->where('s.id','=',$student_id)
        ->groupBy('s.id')
        ->get()
        ->first();
        if($student){
            $this->student = [
                "id" => $student->id,
                "student_code" => $student->student_code,
                "first_name" => $student->first_name,
                "middle_name" => $student->middle_name,
                "last_name" => $student->last_name,
                "email" => $student->email,
                "is_muslim" => $student->is_muslim,
            ];
        // dd($this->student );
        }else{
            return redirect()->route('csc-payments');
        }
    }
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
    public function render(){
        $enrolled_student = DB::table('enrolled_students as es')
            ->select(
                'year_start',
                'year_end',
                'es.school_year_id',
                'sm.semester',
                'sm.id as semester_id',
                'c.id as college_id',
                'c.name as college_name',
                'd.name as department_name',
                'd.id as department_id'
            )
            ->join('semesters as sm','sm.id','es.semester_id')
            ->join('school_years as sy','sy.id','es.school_year_id')
            ->join('colleges as c','c.id','es.college_id')
            ->join('departments as d','d.id','es.department_id')
            ->where('es.student_id','=',$this->student_id)
            ->where('es.school_year_id','=',$this->user_details->school_year_id)
            ->where('es.college_id','=',$this->user_details->college_id)
            ->orderBy('sm.id','desc')
            ->get()
            ->toArray();
            // dd($enrolled_student);
        if($enrolled_student){
            $current_enrolled_student = $enrolled_student['0'];
            $fees = DB::table('fees as f')
                ->select(
                    'f.id',
                    'f.name as fee_name',
                    'f.code as fee_code',
                    'ft.name as fee_type_name',
                    'f.fee_type_id',
                    'f.for_muslim',
                    'f.department_id',
                    'f.amount'
                    )
                ->where('f.school_year_id','=',$current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$current_enrolled_student->semester_id)
                ->join('fee_types as ft','ft.id','f.fee_type_id')
                ->get()
                ->toArray();
                // preprocess
                if($fees){
                    $university_fees = [];
                    $local_fees = [];
                    $local_fees_extra = [];
                    $university_fee_type_id = DB::table('fee_types')
                        ->select('id')
                        ->where('name','=','University Fee')
                        ->first()->id;
                    $local_fee_type_id = DB::table('fee_types')
                        ->select('id')
                        ->where('name','=','Local Fee')
                        ->first()->id;
                    foreach ($fees as $key => $value) {
                        if($value->fee_type_id == $university_fee_type_id ){
                            // for muslim only
                            if($value->for_muslim == 1){
                                if($this->student['is_muslim'] == 1){
                                    array_push($university_fees,$value);
                                }
                            }else{
                                // for everyone
                                array_push($university_fees,$value);
                            }
                        }elseif( $value->fee_type_id == $local_fee_type_id ){
                            if($value->department_id == $current_enrolled_student->department_id){
                                array_push($local_fees_extra,$value);
                            }else{
                                array_push($local_fees,$value);
                            } 
                        }
                    }
                    // dd( $university_fees,$local_fees,$local_fees_extra);
                }
        }
        // fees
    
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        
        return view('livewire.csc.payments.student-payments')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
