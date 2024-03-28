<?php

namespace App\Livewire\Usc\Dashboard;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $title = "Dashboard";
    public $filters = [
        'semester_id'=>NULL,
    ];
    public $dashboard_data = [
        'total_remitted' =>0,
        'total_collected' =>0,
        'usc_shares' => 0,
        'csc_shares' => 0,
        'number_of_enrolled_students' => 0,
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
    public function mount(){
        $first_semester = DB::table('semesters')
        ->where('semester','=','1st Semester')
        ->first();
        $this->filters['semester_id'] =  $first_semester->id;
    }
    public function render()
    {
        $semesters = DB::table('semesters')
            ->get()
            ->toArray();
        $total_collected = DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as total_collected'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->first();
        $local_fee_type = DB::table('fee_types')
            ->where('name','=','Local Fee')
            ->first();
        
        $university_fee_type = DB::table('fee_types')
        ->where('name','=','University Fee')
        ->first();
        

        $csc_shares =  DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as csc_shares'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.college_id','<>',0)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->first();
            
        $msa_shares =  DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as msa_shares'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.college_id','=',0)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->where('f.for_muslim','=',1 )
            ->first();
        $usc_shares =  DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as usc_shares'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.college_id','=',0)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->first();
        

        $paid_per_department =  DB::table('enrolled_students as es')
            ->select(
                'd.id as department_id',
                'd.name as department_name',
                'd.code as department_code',
                DB::raw('sum(pi.amount) as paid_per_department'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->join('departments as d','d.id','es.department_id')
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->groupBy('es.department_id')
            ->get()
            ->toArray();
            // dd($paid_per_department);
            
        $number_of_enrolled_students = DB::table('enrolled_students as es')
            ->select(
                DB::raw('count(*) as number_of_enrolled_students')
            )
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('es.semester_id','=',$this->filters['semester_id'])
            ->first();
        $total_remitted = DB::table('remits as r')
            ->select(
                'c.name as college_name',
                'c.code as college_code',
                'r.college_id',
                DB::raw('sum(amount) as total_remitted')
            )
            ->join('colleges as c','c.id','r.college_id')
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->where('r.semester_id','=',$this->filters['semester_id'])
            ->groupBy('r.college_id')
            ->where('appoved_by','>',0)
            ->get()
            ->toArray();
        if($total_collected){
            $this->dashboard_data['total_collected'] = $total_collected->total_collected;
        }
        if($usc_shares){
            $this->dashboard_data['usc_shares'] = $usc_shares->usc_shares;
        }
        if($csc_shares){
            $this->dashboard_data['csc_shares'] = $csc_shares->csc_shares;
        }
        if($msa_shares){
            $this->dashboard_data['usc_shares'] -= $msa_shares->msa_shares;
            $this->dashboard_data['msa_shares'] = $msa_shares->msa_shares;
        }
        if($number_of_enrolled_students){
            $this->dashboard_data['number_of_enrolled_students'] = $number_of_enrolled_students->number_of_enrolled_students;
        }
        $this->dashboard_data['total_remitted'] = [];
        if($total_remitted){
            $this->dashboard_data['total_remitted'] = $total_remitted;
        }
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
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'] )
            ->orderBy('pi.date_created','desc')
            ->groupBy('pi.id')
            ->limit(5)
            ->get()
            ->toArray();

        
        $page_info = DB::table('users as u')
        ->select(
            'c.name as college_name',
            DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
          )
        ->where('u.id','=',$this->user_details->id)
        ->leftjoin('colleges as c','c.id','u.college_id')
        ->join('school_years as sy','sy.id','u.school_year_id')
        ->get()
        ->first();
        $this->dispatch('renderCharts');
        
        return view('livewire.usc.dashboard.dashboard',[
            'page_info'=>$page_info,
            'semesters'=>$semesters,
            'payment_records_data'=>$payment_records_data,
            'paid_per_department'=>$paid_per_department
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
