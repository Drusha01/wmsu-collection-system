<?php

namespace App\Livewire\Usc\Paymentrecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Paymentrecords extends Component
{
    use WithPagination;
    public $title = "PaymentRecords";
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'school_year_id'=> NULL,
        'college_id' => NULL,
        'fee_id' => NULL,
        'search'=> NULL,
        'search_by' => 'Student code',
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prev_search'=> NULL,
        'prev_school_year_id'=> NULL,
        'prev_fee_id' => NULL,
        
    ];
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Collector name',
    ];
    public $college_data;
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
        $this->college_data = DB::table('colleges')
            ->get()
            ->toArray();
    }
    public function updateSearchDefault(){
        $this->filters['search'] = "";
        $this->filters['prev_search'] = "";
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
        if($this->filters['fee_id'] != $this->filters['prev_fee_id']){
            $this->filters['prev_fee_id'] =$this->filters['fee_id'];
            $this->resetPage();
        }
       
        $payment_records_data = [];
        if($this->filters['search_by'] == 'Student code'){
            if($this->filters['college_id']){
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                  ->where('s.college_id','=',$this->filters['college_id'])
                ->where('s.student_code','like',$this->filters['search'] .'%')
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }else{
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where('s.student_code','like',$this->filters['search'] .'%')
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
            
        }elseif($this->filters['search_by'] == 'Student name'){
            if($this->filters['college_id']){
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->where('s.college_id','=',$this->filters['college_id'])
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }else{
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
        }elseif($this->filters['search_by'] == 'Collector name'){
            if($this->filters['college_id']){
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where('s.college_id','=',$this->filters['college_id'])
                ->where(DB::raw("CONCAT(u.first_name,' ',u.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }else{
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
                ->where('f.school_year_id','like',$this->filters['school_year_id'] .'%')
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(u.first_name,' ',u.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.id','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
           
        }
            
           
        
        
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
            return view('livewire.usc.paymentrecords.paymentrecords',[
                'payment_records_data'=>$payment_records_data,
                'page_info'=>$page_info
            ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
