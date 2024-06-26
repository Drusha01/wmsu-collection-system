<?php

namespace App\Livewire\Usc\Fees;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Fees extends Component
{
    use WithPagination;
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
        'for_muslim' => NULL,
    ];
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'fee_name'=>NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'prev_fee_name'=>NULL,
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
    public $table_filters;
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
        if(!($table = DB::table('tables')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_name','=','Usc-Fees')
            ->first())){
            $table = [
                'id' => NULL,
                'user_id' => $this->user_details->id,
                'table_name' => 'Usc-Fees',
                'table_max_display' => 10,
            ];
            DB::table('tables')
                ->insert([
                    'user_id' => $this->user_details->id,
                    'table_name' => 'Usc-Fees',
                    'table_max_display' => 10,
            ]);

            $table = DB::table('tables')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_name','=','Usc-Fees')
            ->first();
        }
    
        
        if($table && $table_filters = DB::table('table_filters')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_id','=',$table->id)
            ->first()){
            if($table_filters){
                $filter_content = [];
                $decoded_table_filters = json_decode($table_filters->filter_content);
                foreach ($decoded_table_filters as $key => $value) {
                    $item_content = [
                        'column'=> $value->column,
                        'active'=> $value->active,
                        'column_name'=>$value->column_name,
                        'class'=>$value->class,
                        'style'=>$value->style
                    ];
                    array_push($filter_content,$item_content);
                }
                $this->table_filters = [
                    'id' => $table_filters->id,
                    'table_max_display' => $table->table_max_display,
                    'table_id' => $table->id,
                    'user_id' => $this->user_details->id,
                    'filter_content' => $filter_content,
                ];
            }
        }else{
            $filter_content = [
                [
                    'column'=> '#',
                    'active'=> true,
                    'column_name'=>NULL,
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Fee Name',
                    'active'=> true,
                    'column_name'=>'fee_name',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Fee Type',
                    'active'=> true,
                    'column_name'=>'fee_type_name',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Fee Code',
                    'active'=> true,
                    'column_name'=>'fee_code',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'For Muslim?',
                    'active'=> true,
                    'column_name'=>NULL,
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'School Year',
                    'active'=> true,
                    'column_name'=>'school_year',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Semester',
                    'active'=> true,
                    'column_name'=>'semester',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Start Date',
                    'active'=> true,
                    'column_name'=>NULL,
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'End Date',
                    'active'=> true,
                    'column_name'=>NULL,
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Created By',
                    'active'=> true,
                    'column_name'=>'created_by_fullname',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Amount',
                    'active'=> true,
                    'column_name'=>'amount',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Action',
                    'active'=> true,
                    'column_name'=>NULL,
                    'class'=>'text-center',
                    'style'=>NULL],
            ];
            DB::table('table_filters')
                ->insert([
                    'table_id' =>$table->id,
                    'user_id' =>$this->user_details->id,
                    'filter_content' =>json_encode($filter_content),
                ]);
            $table_filters = DB::table('table_filters')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_id','=',$table->id)
            ->first();
            if($table_filters){
                $filter_content = [];
                $decoded_table_filters = json_decode($table_filters->filter_content);
                foreach ($decoded_table_filters as $key => $value) {
                    $item_content = [
                        'column'=> $value->column,
                        'active'=> $value->active,
                        'column_name'=>$value->column_name,
                        'class'=>$value->class,
                        'style'=>$value->style
                    ];
                    array_push($filter_content,$item_content);
                }
                $this->table_filters = [
                    'id' => $table_filters->id,
                    'table_id' => $table->id,
                    'table_max_display' => $table->table_max_display,
                    'user_id' => $this->user_details->id,
                    'filter_content' => $filter_content,
                ];
            }
        }
    }
    public function tableFilter($modal_id){
        $this->dispatch('openModal',$modal_id);
    }
    public function saveTableFilter($id,$modal_id){
        DB::table('table_filters')
            ->where('user_id','=',$this->user_details->id)
            ->where('id','=',$id)
            ->update([
            'filter_content' =>json_encode($this->table_filters['filter_content']),
        ]);
        $this->dispatch('swal:redirect',
            position         									: 'center',
            icon              									: 'success',
            title             									: 'Successfully updated!',
            showConfirmButton 									: 'true',
            timer             									: '1000',
            link              									: '#'
        );
        $this->dispatch('closeModal',$modal_id);
    }
    public function updateTableMaxDisplay(){
        if(DB::table('tables')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_name','=','Usc-PaymentRecords')
            ->update([
                'table_max_display'=>$this->table_filters['table_max_display']
            ])){
            $this->resetPage();
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
        }
    }

    public function render(){

        if($this->filters['fee_name'] != $this->filters['prev_fee_name']){
            $this->filters['prev_fee_name'] =$this->filters['fee_name'];
            $this->resetPage();
        }
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
                'f.name as fee_name',
                'f.code as fee_code',
                'f.amount',
                'f.name as fee_type_name',
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year'),
                's.semester as semester',
                's.date_start_month',
                's.date_start_date',
                's.date_end_month',
                's.date_end_date',
                'u.first_name',
                'u.last_name',
                'u.middle_name',
                'u.id as user_id',
                'f.for_muslim'
            )
            ->join('fee_types as ft','ft.id','f.fee_type_id')
            ->join('users as u','u.id','f.created_by')
            ->join('school_years as sy','sy.id','f.school_year_id')
            ->join('semesters as s','s.id','f.semester_id')
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.fee_type_id','=',$fee_type->id)
            ->where('f.name','like',$this->filters['fee_name'] .'%')
            ->paginate($this->table_filters['table_max_display']);
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
        return view('livewire.usc.fees.fees',[
            'university_fees_data'=> $university_fees_data,
            'page_info'=>$page_info])
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
            'for_muslim' =>NULL,
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
            'for_muslim' => $this->fee['for_muslim'],
        ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has added a fee ('.$this->fee['code'].') '.$this->fee['name'],
                'link' => route('admin-fees'),
            ]);
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
                'for_muslim' => NULL,
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
            'for_muslim' => $fee->for_muslim,
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
            'for_muslim' => $this->fee['for_muslim'],
        ])){
        }
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has updated a fee ('.$this->fee['code'].') '.$this->fee['name'],
                'link' => route('admin-fees'),
            ]);
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
                'for_muslim' => NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
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
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has deleted a fee ('.$this->fee['code'].') '.$this->fee['name'],
                'link' => route('admin-fees'),
            ]);
            $this->fee = [
                'id' => NULL,
                'name' => NULL, 
                'code' => NULL,
                'fee_type_id' => NULL,
                'amount' => NULL,
                'school_year_id' => NULL,
                'semester_id' => NULL,
                'for_muslim' => NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
}
