<?php

namespace App\Livewire\Csc\Payments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentPayments extends Component
{
    use WithPagination;
    use WithFileUploads;
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
    public $export_types = [
        0=>['name'=>'EXCEL'],
        1=>['name'=>'CSV'],
        2=>['name'=>'PDF'],

    ];
    public $export_selected = 'EXCEL';
    public $student_id;
    public $semesters;
    public $colleges_data;
    public $department_data;
    public $year_levels;
    public $student_id_search;
    public $prevstudent_id_search;
    public $current_enrolled_student;
    public $enrolled_student;
    public $payment_history = [
        'payment_history'=>[],
    ];
    public $partial = [
        'promisory_note' => NULL,
        'amount'=>NULL,
    ];
    public $void = [
        'amount'=>NULL,
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
    public function mount(Request $request,$student_id,$semester = 1){
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
            "s.is_muslim",
            "d.name as department_name"
        )
        ->rightjoin('enrolled_students as es','es.student_id','s.id')
        ->join('departments as d','es.department_id','d.id')
        ->where('s.id','=',$student_id)
        ->limit(1)
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
                "department_name"=>$student->department_name
            ];
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
                ->orderBy('sm.id','asc')
                ->first();
            if($this->enrolled_student){
                $this->current_enrolled_student = $this->enrolled_student;
                $this->filters['semester_id'] = $this->enrolled_student->semester_id;
                    
            }
            if($semester){
                $this->filters['semester_id'] = $semester;
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
    
    public function render(){
        $fees = [];
        if($this->enrolled_student){
            $this->total = [
                'total_amount'=>0,
                'total_amount_paid'=>0,
                'total_balance'=>0,
            ];
            $university_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',0)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();

            $local_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',$this->user_details->college_id)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();
            
            // preprocess
            if($university_fees || $local_fees){
                $fees = [];
                $university_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','University Fee')
                    ->first()->id;
                $local_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','Local Fee')
                    ->first()->id;
                foreach ($university_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }
                foreach ($local_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }

                foreach ($fees as $key => $value) {
                    $this->total['total_amount'] = $this->total['total_amount']+$value->amount;
                    $this->total['total_amount_paid'] = $this->total['total_amount_paid']+$value->paid_amount;
                    $this->total['total_balance'] = $this->total['total_balance']+($value->amount - $value->paid_amount);
                }
            }
        }
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

        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        
        return view('livewire.csc.payments.student-payments',[
            'fees'=>$fees,
            'page_info'=>$page_info
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function updateSemester(){
        $this->filters['semester_id'] = $this->filters['semester_id'];
    }
    public function confirmPayment($modal_id){
        // check if we have partial
        $total = [
            'total_amount'=>0,
            'total_amount_paid'=>0,
            'total_balance'=>0,
        ];
        $university_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',0)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();

            $local_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',$this->user_details->college_id)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();
            
            // preprocess
            if($university_fees || $local_fees){
                $fees = [];
                $university_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','University Fee')
                    ->first()->id;
                $local_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','Local Fee')
                    ->first()->id;
                foreach ($university_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }
                foreach ($local_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }

                foreach ($fees as $key => $value) {
                    $total['total_amount'] = $total['total_amount']+$value->amount;
                    $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                    $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
                }
            }
            
            $payment = [  
                'id' => NULL,
                'student_id' => $this->student['id'],
                'school_year_id' => $this->current_enrolled_student->school_year_id,
                'semester_id' => $this->filters['semester_id'],
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
            $student_info = DB::table('students')
                ->where('id','=',$this->student['id'])
                ->get()
                ->first();
            if($student_info){
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$payment['school_year_id'],
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has collected an amount of ('.$payment['amount'].') from ('.$student_info->student_code.') '. $student_info->first_name.' '.$student_info->middle_name.' '.$student_info->last_name ,
                    'link' =>route('admin-paymentrecords'),
                ]);
            }
                       
            foreach ($fees as $key => $value) {
                if( floatval($value->amount) - floatval($value->paid_amount) > 0){
                    DB::table('payment_items')
                    ->insert([
                        'id' => NULL,
                        'payment_id' => $payment_id,
                        'fee_id' => $value->id,
                        'student_id' => $payment['student_id'],
                        'amount' => floatval($value->amount) - floatval($value->paid_amount) ,
                        'collected_by' => $payment['collected_by'],
                    ]);
                }
            }
            $payment_status = DB::table('status')
                ->where('name','=','Paid')
                ->first();
            DB::table('enrolled_students as es')
                ->where('es.student_id','=',$this->student_id)
                ->where('es.school_year_id','=',$this->user_details->school_year_id)
                ->where('es.college_id','=',$this->user_details->college_id)
                ->where('es.semester_id','=',$payment['semester_id'])
                ->update([
                    'payment_status' => $payment_status->id
                ]);
            
        $this->dispatch('closeModal',$modal_id);
    }
    public function confirmPartialDefault($modal_id){
        $this->partial = [
            'promisory_note' => NULL,
            'amount'=>NULL,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function confirmVoidDefault($modal_id){
        $this->void = [
            'amount'=> NULL,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function confirmPaymentDefault($modal_id){
        $this->dispatch('openModal',$modal_id);
    }
    
    public function confirmPartial($modal_id){
        $total = [
            'total_amount'=>0,
            'total_amount_paid'=>0,
            'total_balance'=>0,
        ];
        $university_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',0)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();

            $local_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',$this->user_details->college_id)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();
            
            // preprocess
            if($university_fees || $local_fees){
                $fees = [];
                $university_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','University Fee')
                    ->first()->id;
                $local_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','Local Fee')
                    ->first()->id;
                foreach ($university_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }
                foreach ($local_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }

                foreach ($fees as $key => $value) {
                    $total['total_amount'] = $total['total_amount']+$value->amount;
                    $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                    $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
                }
            }
            $partial['promisory_note'] = NULL;
            if( $total['total_balance'] > 0 &&( $this->partial['amount'] > $total['total_balance']) ){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Partial amount exceeded the balance! ('. number_format($total['total_balance'], 2).')',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }elseif(floatval($this->partial['amount']) > 0 && $total['total_balance'] > 0 && ( $this->partial['amount'] <= $total['total_balance'])){
                if($this->partial['promisory_note']){
                    $partial['promisory_note'] = self::save_image($this->partial['promisory_note'],'promisory_note','payments','promisory_note');
                    if($partial['promisory_note'] == 0){
                        return;
                    }
                }
             
            }
            $payment = [  
                'id' => NULL,
                'student_id' => $this->student['id'],
                'school_year_id' => $this->current_enrolled_student->school_year_id,
                'semester_id' => $this->filters['semester_id'],
                'amount' => $this->partial['amount']  ,
                'promisory_note'=> $partial['promisory_note'],
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
                    'promisory_note' => $payment['promisory_note'],
                ]);
            $payment_id = DB::table('payments as p')
                ->select('p.id')
                ->where('p.student_id','=',$payment['student_id'])
                ->where('p.semester_id','=',$payment['semester_id'])
                ->where('p.school_year_id','=',$payment['school_year_id'])
                ->where('p.amount','=',$payment['amount'])
                ->orderBy('p.id','desc')
                ->first();
            $student_info = DB::table('students')
                ->where('id','=',$this->student['id'])
                ->get()
                ->first();
            if($student_info){
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$payment['school_year_id'],
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has collected a partial payment of ('.$payment['amount'].') from ('.$student_info->student_code.') '. $student_info->first_name.' '.$student_info->middle_name.' '.$student_info->last_name ,
                    'link' =>route('admin-paymentrecords'),
                ]);
            }
            if($payment_id){
                $payment_id = $payment_id->id;
            }
                       
            foreach ($fees as $key => $value) {
                if($payment['amount'] > 0){
                    if( floatval($value->amount) - floatval($value->paid_amount) > 0){
                        $amount = floatval($value->amount) - floatval($value->paid_amount);
                        if($payment['amount'] >= $amount ){
                            DB::table('payment_items')
                            ->insert([
                                'id' => NULL,
                                'payment_id' => $payment_id,
                                'fee_id' => $value->id,
                                'student_id' => $payment['student_id'],
                                'amount' => floatval($value->amount) - floatval($value->paid_amount) ,
                                'collected_by' => $payment['collected_by'],
                            ]);
                        }else{
                            DB::table('payment_items')
                            ->insert([
                                'id' => NULL,
                                'payment_id' => $payment_id,
                                'fee_id' => $value->id,
                                'student_id' => $payment['student_id'],
                                'amount' => $payment['amount'] ,
                                'collected_by' => $payment['collected_by'],
                            ]);
                        }
                        $payment['amount'] = $payment['amount'] - $amount;
                    }
                }
            }
            if( $this->partial['amount'] == $total['total_amount']){
                $payment_status = DB::table('status')
                    ->where('name','=','Paid')
                    ->first();
            }elseif($this->partial['amount'] < $total['total_amount']){
                $payment_status = DB::table('status')
                    ->where('name','=','Partial')
                    ->first();
            }
           
           
            DB::table('enrolled_students as es')
                ->where('es.student_id','=',$this->student_id)
                ->where('es.school_year_id','=',$this->user_details->school_year_id)
                ->where('es.college_id','=',$this->user_details->college_id)
                ->where('es.semester_id','=',$payment['semester_id'])
                ->update([
                    'payment_status' => $payment_status->id
                ]);
            
        $this->dispatch('closeModal',$modal_id);
    }

    public function confirmVoid($modal_id){
        $total = [
            'total_amount'=>0,
            'total_amount_paid'=>0,
            'total_balance'=>0,
        ];
        $university_fees =DB::table('enrolled_students as es')
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
            ->where('f.college_id','=',0)
            ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'])
            ->groupBy('f.id')
            ->get()
            ->toArray();

        $local_fees =DB::table('enrolled_students as es')
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
            ->where('f.college_id','=',$this->user_details->college_id)
            ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
            ->where('f.semester_id','=',$this->filters['semester_id'])
            ->groupBy('f.id')
            ->get()
            ->toArray();
        
        // preprocess
        if($university_fees || $local_fees){
            $fees = [];
            $university_fee_type_id = DB::table('fee_types')
                ->select('id')
                ->where('name','=','University Fee')
                ->first()->id;
            $local_fee_type_id = DB::table('fee_types')
                ->select('id')
                ->where('name','=','Local Fee')
                ->first()->id;
            foreach ($university_fees as $key => $value) {
                if($value->fee_type_id == $university_fee_type_id ){
                    // for muslim only
                    if($value->for_muslim == 1){
                        if($this->student['is_muslim'] == 1){
                            array_push($fees,$value);
                        }
                    }else{
                        // for everyone
                        array_push($fees,$value);
                    }
                }elseif( $value->fee_type_id == $local_fee_type_id ){
                    if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                        array_push($fees,$value);
                    }elseif(intval($value->department_id) == 0){
                        array_push($fees,$value);
                    } 
                }
            }
            foreach ($local_fees as $key => $value) {
                if($value->fee_type_id == $university_fee_type_id ){
                    // for muslim only
                    if($value->for_muslim == 1){
                        if($this->student['is_muslim'] == 1){
                            array_push($fees,$value);
                        }
                    }else{
                        // for everyone
                        array_push($fees,$value);
                    }
                }elseif( $value->fee_type_id == $local_fee_type_id ){
                    if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                        array_push($fees,$value);
                    }elseif(intval($value->department_id) == 0){
                        array_push($fees,$value);
                    } 
                }
            }
            foreach ($fees as $key => $value) {
                $total['total_amount'] = $total['total_amount']+$value->amount;
                $total['total_amount_paid'] = $total['total_amount_paid']+$value->paid_amount;
                $total['total_balance'] = $total['total_balance']+($value->amount - $value->paid_amount);
            }
        }
        if(  $this->void['amount'] > $total['total_amount_paid']) {
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Void amount exceeded the total amount! ('. number_format($total['total_amount_paid'], 2).')',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        
        $payment = [  
            'id' => NULL,
            'student_id' => $this->student['id'],
            'school_year_id' => $this->current_enrolled_student->school_year_id,
            'semester_id' => $this->filters['semester_id'],
            'amount' => -($this->void['amount'])  ,
            'promisory_note'=> NULL,
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
                'promisory_note' => $payment['promisory_note'],
            ]);
        $payment_id = DB::table('payments as p')
            ->select('p.id')
            ->where('p.student_id','=',$payment['student_id'])
            ->where('p.semester_id','=',$payment['semester_id'])
            ->where('p.school_year_id','=',$payment['school_year_id'])
            ->where('p.amount','=',$payment['amount'])
            ->orderBy('p.id','desc')
            ->first();
            $student_info = DB::table('students')
                ->where('id','=',$this->student['id'])
                ->get()
                ->first();
            if($student_info){
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$payment['school_year_id'],
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has voided a payment of  ('.$payment['amount'].') from ('.$student_info->student_code.') '. $student_info->first_name.' '.$student_info->middle_name.' '.$student_info->last_name ,
                    'link' =>route('admin-paymentrecords'),
                ]);
            }
        if($payment_id){
            $payment_id = $payment_id->id;
        }
                    
        foreach ($fees as $key => $value) {
            if($payment['amount'] < 0){
                if(floatval($value->paid_amount) > 0){
                    if($payment['amount']  < (-(floatval($value->paid_amount) )) ){
                        DB::table('payment_items')
                        ->insert([
                            'id' => NULL,
                            'payment_id' => $payment_id,
                            'fee_id' => $value->id,
                            'student_id' => $payment['student_id'],
                            'amount' =>-(floatval($value->paid_amount)),
                            'collected_by' => $payment['collected_by'],
                        ]);
                    }else{
                        DB::table('payment_items')
                        ->insert([
                            'id' => NULL,
                            'payment_id' => $payment_id,
                            'fee_id' => $value->id,
                            'student_id' => $payment['student_id'],
                            'amount' => $payment['amount'] ,
                            'collected_by' => $payment['collected_by'],
                        ]);
                    }
                    $payment['amount'] = $payment['amount'] + $value->paid_amount;
                }
            }
        }
        if( $this->void['amount'] == $total['total_amount_paid']){
            $payment_status = DB::table('status')
                ->where('name','=','Unpaid')
                ->first();
        }elseif($this->void['amount'] < $total['total_amount_paid']){
            $payment_status = DB::table('status')
                ->where('name','=','Partial')
                ->first();
        }
       
       
        DB::table('enrolled_students as es')
            ->where('es.student_id','=',$this->student_id)
            ->where('es.school_year_id','=',$this->user_details->school_year_id)
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('es.semester_id','=',$payment['semester_id'])
            ->update([
                'payment_status' => $payment_status->id
            ]);
        $this->dispatch('closeModal',$modal_id);
    }
    public function PaymentHistory($modal_id){
        $payment_history =  DB::table('payment_items as pi')
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
        ->where('es.college_id','=',$this->user_details->college_id)
        ->where('s.id','=',$this->student_id)
        ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
        ->where('f.semester_id','=',$this->filters['semester_id'])
        ->orderBy('pi.date_created','asc')
        ->groupBy('pi.id')
        ->get()
        ->toArray();

        $this->payment_history = [
            'payment_history'=> $payment_history,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function downloadReceipt(){
        $payment_history =  DB::table('payment_items as pi')
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
        ->where('es.college_id','=',$this->user_details->college_id)
        ->where('s.id','=',$this->student_id)
        ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
        ->where('f.semester_id','=',$this->filters['semester_id'])
        ->orderBy('pi.date_created','asc')
        ->groupBy('pi.id')
        ->get()
        ->toArray();

        if($this->enrolled_student){
            $this->total = [
                'total_amount'=>0,
                'total_amount_paid'=>0,
                'total_balance'=>0,
            ];
            $university_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',0)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();

            $local_fees =DB::table('enrolled_students as es')
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
                ->where('f.college_id','=',$this->user_details->college_id)
                ->where('f.school_year_id','=',$this->current_enrolled_student->school_year_id)
                ->where('f.semester_id','=',$this->filters['semester_id'])
                ->groupBy('f.id')
                ->get()
                ->toArray();
            
            // preprocess
            if($university_fees || $local_fees){
                $fees = [];
                $university_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','University Fee')
                    ->first()->id;
                $local_fee_type_id = DB::table('fee_types')
                    ->select('id')
                    ->where('name','=','Local Fee')
                    ->first()->id;
                foreach ($university_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }
                foreach ($local_fees as $key => $value) {
                    if($value->fee_type_id == $university_fee_type_id ){
                        // for muslim only
                        if($value->for_muslim == 1){
                            if($this->student['is_muslim'] == 1){
                                array_push($fees,$value);
                            }
                        }else{
                            // for everyone
                            array_push($fees,$value);
                        }
                    }elseif( $value->fee_type_id == $local_fee_type_id ){
                        if(intval($value->department_id) > 0 && $value->department_id == $this->current_enrolled_student->department_id){
                            array_push($fees,$value);
                        }elseif(intval($value->department_id) == 0){
                            array_push($fees,$value);
                        } 
                    }
                }

                foreach ($fees as $key => $value) {
                    $this->total['total_amount'] = $this->total['total_amount']+$value->amount;
                    $this->total['total_amount_paid'] = $this->total['total_amount_paid']+$value->paid_amount;
                    $this->total['total_balance'] = $this->total['total_balance']+($value->amount - $value->paid_amount);
                }
            }
        }

        $student_info  = DB::table('students')
            ->where('id','=', $this->student_id)
            ->first();
        $student_semester = DB::table('semesters')
            ->where('id','=',$this->filters['semester_id'])
            ->first();
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
        $file_name = $student_info->student_code.' - '.$student_info->first_name.' '.$student_info->middle_name.' '.$student_info->last_name.' ('.$page_info->school_year.' '.$student_semester->semester.')';
        $this->payment_history = [
            'payment_history'=> $payment_history,
        ];
        $type = $this->export_selected;
        $header = [];
        $content = [];
        array_push($content,['Summaries']);
        array_push($content,[
            '#',
            'Fee Type',
            'Fee Code',
            'Fee Name',
            'Amount',
            'Amount Paid',
            'Balance',
            'Status',
        ]);
            
        foreach ($fees as $key => $value) {
            $content_item = [];   
            $status = NULL;   
            if(floatval($value->paid_amount) && floatval($value->paid_amount) < $value->amount){
                $status = 'Partial';
            }elseif(floatval($value->paid_amount) && floatval($value->paid_amount) == $value->amount){
                $status = 'Paid';
            }elseif(!(floatval($value->paid_amount))){
                $status = 'Unpaid';
            }  
            array_push($content_item,$key+1);
            array_push($content_item,$value->fee_type_name);
            array_push($content_item,$value->fee_code);
            array_push($content_item,$value->fee_name);
            array_push($content_item,$value->amount);
            array_push($content_item,$value->paid_amount);
            array_push($content_item,($value->amount - $value->paid_amount));
            array_push($content_item, $status );
            array_push($content,$content_item);
        }
        array_push($content,[]);
        array_push($content,[]);

        array_push($content, ['Payment History']);
        array_push($content, [
            '#',
            'Student Code',
            'Student Name',
            'Fee Type',
            'Fee Code',
            'Fee Name',
            'Amount Collected',
            'Collected By',
            'Collected at'
        ]);
        
        foreach ($payment_history as $key =>$value){
            $content_item = [];          
            array_push($content_item,$key+1);
            array_push($content_item,$value->student_code);
            array_push($content_item,$value->student_first_name. ' ' .$value->student_middle_name.' ' .$value->student_last_name );
            array_push($content_item,$value->fee_type_name);
            array_push($content_item,$value->fee_code);
            array_push($content_item,$value->fee_name);
            array_push($content_item,$value->amount);
            array_push($content_item,$value->collector_first_name. ' ' .$value->collector_middle_name.' ' .$value->collector_last_name );
            array_push($content_item,date_format(date_create($value->date_created),"M d, Y h:i a"));
            array_push($content,$content_item);
        }
        array_push($content,[]);
        array_push($content,[]);
       
        if($type == 'EXCEL'){
            $export = new ExporterController([
                $header,
                $content
            ]);
            return Excel::download($export, $file_name.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }elseif($type == 'CSV'){
            $export = new ExporterController([
                $header,
                $content
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }elseif($type == 'PDF'){
            $data = [
                'title'=>$file_name,
                'content'=> $content
            ];
            $data = self::convert_from_latin1_to_utf8_recursively($data);
            $pdf = Pdf::loadView('livewire.csc.export.exportpdf',  array( 
                'title'=> $file_name,
                'content'=> $content)
            );
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->setPaper('a4', 'landscape')->stream();
            },  $file_name.'.pdf');
        }else{
            $export = new ExporterController([
                $header,
                $content
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
    public function convert_from_latin1_to_utf8_recursively($dat){
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);
         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);
         return $dat;
      } else {
         return $dat;
      }
   }
    public function save_image($image_file,$folder_name,$table_name,$column_name){
        if($image_file && file_exists(storage_path().'/app/livewire-tmp/'.$image_file->getfilename())){
            $file_extension =$image_file->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$image_file->getfilename();
            $size = Storage::size($tmp_name);
            $mime = Storage::mimeType($tmp_name);
            $max_image_size = 25 * 1024*1024; 
            $file_extensions = array('image/jpeg','image/png','image/jpg');
            
            if($size<= $max_image_size){
                $valid_extension = false;
                foreach ($file_extensions as $value) {
                    if($value == $mime){
                        $valid_extension = true;
                        break;
                    }
                }
                if($valid_extension){
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table($table_name)
                    ->where([$column_name=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/content/'.$folder_name.'/'.$new_file_name)){
                        return $new_file_name;
                    }
                }else{
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'warning',
                        title             									: 'Invalid image type!',
                        showConfirmButton 									: 'true',
                        timer             									: '1000',
                        link              									: '#'
                    );
                    return 0;
                }
            }else{
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Image is too large!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return 0;
            } 
        }
        return 0;
    }
}
