<?php

namespace App\Livewire\Admin\PaymentRecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class PaymentRecords extends Component
{
    use WithPagination;
    public $title = "Payments";
    
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'school_year_id'=> NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'prev_school_year_id'=> NULL,
        'search'=> NULL,
        'search_by' => 'Student code',
        'prev_search'=> NULL,
        'prev_fee_id'=> NULL,
        'fee_id'=> NULL,
        
        
    ];
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Collector name',
    ];
    public $fees;
    public $school_years;
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function render()
    {
        if($this->filters['school_year_id'] != $this->filters['prev_school_year_id']){
            $this->filters['prev_school_year_id'] =$this->filters['school_year_id'];
            $this->resetPage();
        }
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
        if($this->filters['fee_id'] != $this->filters['prev_fee_id']){
            $this->filters['prev_fee_id'] =$this->filters['fee_id'];
            $this->resetPage();
        }
        $this->school_years = DB::table('school_years')
        ->orderBy('id','desc')
        ->get()
        ->toArray();
        $this->fees = DB::table('fee_types')
        ->get()
        ->toArray();
        $payment_records_data = [];
        if($this->filters['search_by'] == 'Student code'){
            if($this->filters['school_year_id']){
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
                ->where('es.college_id','<>',0)
                ->where('f.school_year_id','=',$this->filters['school_year_id'])
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where('s.student_code','like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
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
                ->where('es.college_id','<>',0)
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where('s.student_code','like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
        }elseif($this->filters['search_by'] == 'Student name'){
            if($this->filters['school_year_id']){
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
                ->where('es.college_id','<>',0)
                ->where('f.school_year_id','=',$this->filters['school_year_id'])
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
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
                ->where('es.college_id','<>',0)
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
        } elseif($this->filters['search_by'] == 'Collector name'){
            if($this->filters['school_year_id']){
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
                ->where('es.college_id','<>',0)
                ->where('f.school_year_id','=',$this->filters['school_year_id'])
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
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
                ->where('es.college_id','<>',0)
                ->where('f.fee_type_id','like',$this->filters['fee_id'] .'%')
                ->where(DB::raw("CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name)"),'like',$this->filters['search'] .'%')
                ->orderBy('pi.date_created','desc')
                ->groupBy('pi.id')
                ->paginate(10);
            }
        }
        return view('livewire.admin.payment-records.payment-records',[
            'payment_records_data'=>$payment_records_data
        ]) 
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
