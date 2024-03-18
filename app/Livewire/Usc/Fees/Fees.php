<?php

namespace App\Livewire\Usc\Fees;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Fees extends Component
{
    public $title = "Fees";
    public $term = [];

    public $user_details;
    public $fee = [
        'id' => NULL,
        'name' => NULL, 
        'code' => NULL,
        'fee_type_id' => NULL,
        'amount' => NULL,
        'school_year_id' => NULL,
        'semester_id' => NULL,
        'created_by' => NULL,
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
    public $semesters = [];
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

        $fee_type = DB::table('fee_types')
        ->where('name','=','University Fee')
        ->first();

        $this->term = DB::table('school_years')
            ->where('id','=',$this->user_details->school_year_id)
            ->get()
            ->first();
        $university_fees_data = DB::table('fees as f')
            ->select(
                'f.id',
                'f.name',
                'f.code',
                'f.amount',
                'f.name as fee_type_name',
                'sy.year_start',
                'sy.year_end',
                's.semester as semester',
                's.date_start_month',
                's.date_start_date',
                's.date_end_month',
                's.date_end_date',
                'u.first_name',
                'u.last_name',
                'u.middle_name',
                'u.id as user_id',
            )
            ->join('fee_types as ft','ft.id','f.fee_type_id')
            ->join('users as u','u.id','f.created_by')
            ->join('school_years as sy','sy.id','f.school_year_id')
            ->join('semesters as s','s.id','f.semester_id')
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.fee_type_id','=',$fee_type->id)
            ->paginate(10);
        // dd($university_fees);
        return view('livewire.usc.fees.fees',[
            'university_fees_data'=> $university_fees_data])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addFees($modal_id){
        $fee_type = DB::table('fee_types')
            ->where('name','=','University Fee')
            ->first();
        $this->semesters = DB::table('semesters')
            ->get()
            ->toArray();
        $this->fee = [
            'id' => NULL,
            'name' => NULL, 
            'code' => NULL,
            'fee_type_id' => $fee_type->id,
            'amount' => NULL,
            'school_year_id' => $this->user_details->school_year_id,
            'semester_id' => NULL,
            'created_by' => NULL,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function saveAddFees($modal_id){
        if(strlen($this->fee['name'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee name',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->fee['code'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee code',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(intval($this->fee['amount'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee amount',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!(DB::table('semesters')
            ->where('id','=',$this->fee['semester_id'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select fee semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('fees')
            ->insert([
            'name' => $this->fee['name'], 
            'code' => $this->fee['code'],
            'fee_type_id' => $this->fee['fee_type_id'],
            'amount' => $this->fee['amount'],
            'school_year_id' => $this->fee['school_year_id'],
            'semester_id' => $this->fee['semester_id'],
            'created_by' => $this->user_details->id,
        ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
    public function editFees($id,$modal_id){
        $fee_type = DB::table('fee_types')
        ->where('name','=','University Fee')
        ->first();
        $this->semesters = DB::table('semesters')
            ->get()
            ->toArray();
        $fee = DB::table('fees as f')
            ->where('f.id','=',$id)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.fee_type_id','=',$fee_type->id)
            ->first();
        $this->fee = [
            'id' => $fee->id,
            'name' => $fee->name, 
            'code' => $fee->code,
            'fee_type_id' => $fee_type->id,
            'amount' => $fee->amount,
            'school_year_id' => $this->user_details->school_year_id,
            'semester_id' => $fee->semester_id,
            'created_by' => $fee->created_by,
        ];
        $this->dispatch('openModal',$modal_id);
        return;
    }
    public function saveEditFees($id,$modal_id){
        $fee_type = DB::table('fee_types')
        ->where('name','=','University Fee')
        ->first();
        if(strlen($this->fee['name'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee name',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->fee['code'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee code',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(intval($this->fee['amount'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input fee amount',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!(DB::table('semesters')
            ->where('id','=',$this->fee['semester_id'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select fee semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('fees as f')
            ->where('f.id','=',$id)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.fee_type_id','=',$fee_type->id)
            ->update([
            'name' => $this->fee['name'], 
            'code' => $this->fee['code'],
            'amount' => $this->fee['amount'],
            'semester_id' => $this->fee['semester_id'],
        ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
    public function saveDeleteFees($id,$modal_id){
        $fee_type = DB::table('fee_types')
        ->where('name','=','University Fee')
        ->first();
        if(DB::table('fees as f')
            ->where('f.id','=',$id)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.fee_type_id','=',$fee_type->id)
            ->delete()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully deleted',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
}
