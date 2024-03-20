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
    public $total;
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
    public $current_enrolled_student;
    public $enrolled_student;
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
            $this->enrolled_student = DB::table('enrolled_students as es')
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
            if($this->enrolled_student){
                foreach ($this->enrolled_student as $key => $value) {
                    $this->current_enrolled_student = $value;
                    $this->filters['semester_id'] = $value->semester_id;
                    if( $fees = DB::table('fees as f')
                    ->where('f.school_year_id','=',$value->school_year_id)
                    ->where('f.semester_id','=',$value->semester_id)
                    ->join('fee_types as ft','ft.id','f.fee_type_id')
                    ->first()){
                        break;
                    }
                }
            }
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
        
        if($this->enrolled_student){
            $this->total = [
                'total_amount'=>0,
                'total_amount_paid'=>0,
                'total_balance'=>0,
            ];
            $fees =DB::table('enrolled_students as es')
                ->select(
                    'f.id',
                    'f.name as fee_name',
                    'f.code as fee_code',
                    'ft.name as fee_type_name',
                    'f.fee_type_id',
                    'f.for_muslim',
                    'f.department_id',
                    'f.amount',
                    DB::raw('sum(pi.amount) as paid_amount'),
                )
                ->join('students as s','es.student_id','s.id')
                ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
                ->join('fee_types as ft','f.fee_type_id','ft.id')
                ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
                ->where('s.id','=',$this->student_id)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->current_enrolled_student->semester_id)
                ->groupBy('f.id')
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
                            if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                                array_push($local_fees_extra,$value);
                            }elseif(intval($value->department_id) == 0){
                                array_push($local_fees,$value);
                            } 
                        }
                    }
                    $fees = [];
                   
                    
                    foreach ($university_fees as $key => $value) {
                        $this->total['total_amount'] = $this->total['total_amount']+$value->amount;
                        $this->total['total_amount_paid'] = $this->total['total_amount_paid']+$value->paid_amount;
                        $this->total['total_balance'] = $this->total['total_balance']+($value->amount - $value->paid_amount);
                        array_push($fees,$value);
                    }
                    foreach ($local_fees as $key => $value) {
                        $this->total['total_amount'] = $this->total['total_amount']+$value->amount;
                        $this->total['total_amount_paid'] = $this->total['total_amount_paid']+$value->paid_amount;
                        $this->total['total_balance'] = $this->total['total_balance']+($value->amount - $value->paid_amount);
                        array_push($fees,$value);
                    }
                    foreach ($local_fees_extra as $key => $value) {
                        $this->total['total_amount'] = $this->total['total_amount']+$value->amount;
                        $this->total['total_amount_paid'] = $this->total['total_amount_paid']+$value->paid_amount;
                        $this->total['total_balance'] = $this->total['total_balance']+($value->amount - $value->paid_amount);
                        array_push($fees,$value);
                    }
                }
        }
        // fees
    
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        
        return view('livewire.csc.payments.student-payments',[
            'fees'=>$fees
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function updateSemester(){
        $this->current_enrolled_student->semester_id = $this->filters['semester_id'];
    }
    public function confirmPayment($modal_id){
        // check if we have partial
        $total = [
            'total_amount'=>0,
            'total_amount_paid'=>0,
            'total_balance'=>0,
        ];
        $fees =DB::table('enrolled_students as es')
            ->select(
                'f.id',
                'f.name as fee_name',
                'f.code as fee_code',
                'ft.name as fee_type_name',
                'f.fee_type_id',
                'f.for_muslim',
                'f.department_id',
                'f.amount',
                DB::raw('sum(pi.amount) as paid_amount'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('s.id','=',$this->student_id)
            ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
            ->where('f.semester_id','=',$this->current_enrolled_student->semester_id)
            ->groupBy('f.id')
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
                        if($value->department_id == $this->current_enrolled_student->department_id){
                            array_push($local_fees_extra,$value);
                        }else{
                            array_push($local_fees,$value);
                        } 
                    }
                }
                $fees = [];
               
                
                foreach ($university_fees as $key => $value) {
                    $total['total_amount'] = $total['total_amount']+$value->amount;
                    $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                    $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
                    array_push($fees,$value);
                }
                foreach ($local_fees as $key => $value) {
                    $total['total_amount'] = $total['total_amount']+$value->amount;
                    $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                    $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
                    array_push($fees,$value);
                }
                foreach ($local_fees_extra as $key => $value) {
                    $total['total_amount'] = $total['total_amount']+$value->amount;
                    $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                    $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
                    array_push($fees,$value);
                }
            }
            
            $payment = [  
                'id' => NULL,
                'student_id' => $this->student['id'],
                'school_year_id' => $this->current_enrolled_student->school_year_id,
                'semester_id' => $this->current_enrolled_student->semester_id,
                'amount' =>  $total['total_amount'] - $total['total_amount_paid'] ,
                'collected_by' =>$this->user_details->id
            ];
            DB::table('payments')
                ->insert([
                    'id' => NULL,
                    'student_id' => $payment['student_id'],
                    'semester_id' => $payment['semester_id'],
                    'school_year_id' => $payment['school_year_id'],
                    'amount' => $payment['amount'],
                    'collected_by'=> $payment['collected_by'],
                ]);
            $payment_id = DB::table('payments as p')
                ->select('p.id')
                ->where('p.student_id','=',$payment['student_id'])
                ->where('p.semester_id','=',$payment['semester_id'])
                ->where('p.school_year_id','=',$payment['school_year_id'])
                ->where('p.amount','=',$payment['amount'])
                ->orderBy('p.id','desc')
                ->first();
            if($payment_id){
                $payment_id = $payment_id->id;
            }
                       
            foreach ($fees as $key => $value) {
                if(!($value->paid_amount)){
                    DB::table('payment_items')
                        ->insert([
                            'id' => NULL,
                            'payment_id' => $payment_id,
                            'fee_id' => $value->id,
                            'student_id' => $payment['student_id'],
                            'amount' => $value->amount,
                            'collected_by' => $payment['collected_by'],
                        ]);
                }elseif(intval($value->paid_amount) < intval($value->amount)){
                    DB::table('payment_items')
                        ->insert([
                            'id' => NULL,
                            'payment_id' => $payment_id,
                            'fee_id' => $value->id,
                            'student_id' => $payment['student_id'],
                            'amount' => intval($value->amount) - intval($value->paid_amount) ,
                            'collected_by' => $payment['collected_by'],
                        ]);
                }
                
              
            }
            
        $this->dispatch('closeModal',$modal_id);
    }
}
