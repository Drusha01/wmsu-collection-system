<?php

namespace App\Livewire\Usc\Paymentrecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public $export_selected = 'PDF';
    public $downloadfilters =NULL;
    public $export_types = [
        0=>['name'=>'EXCEL'],
        1=>['name'=>'CSV'],
        2=>['name'=>'PDF'],

    ];
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Collector name',
    ];
    public $college_data;
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
        $this->college_data = DB::table('colleges')
            ->get()
            ->toArray();
        $this->downloadfilters = $this->filters;
        if(!($table = DB::table('tables')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_name','=','Usc-PaymentRecords')
            ->first())){
            $table = [
                'id' => NULL,
                'user_id' => $this->user_details->id,
                'table_name' => 'Usc-PaymentRecords',
                'table_max_display' => 10,
            ];
            DB::table('tables')
                ->insert([
                    'user_id' => $this->user_details->id,
                    'table_name' => 'Usc-PaymentRecords',
                    'table_max_display' => 10,
            ]);

            $table = DB::table('tables')
            ->where('user_id','=',$this->user_details->id)
            ->where('table_name','=','Usc-PaymentRecords')
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
                    'column'=> 'Student Code',
                    'active'=> true,
                    'column_name'=>'student_code',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Student Name',
                    'active'=> true,
                    'column_name'=>'student_fullname',
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
                    'column'=> 'Fee Name',
                    'active'=> true,
                    'column_name'=>'fee_name',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Amount Collected',
                    'active'=> true,
                    'column_name'=>'amount',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Collected By',
                    'active'=> true,
                    'column_name'=>'collected_by_fullname',
                    'class'=>NULL,
                    'style'=>NULL],
                [
                    'column'=> 'Collected at',
                    'active'=> true,
                    'column_name'=>'date_created',
                    'class'=>NULL,
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
                    'table_max_display' => $table->table_max_display,
                    'table_id' => $table->id,
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
        $fees = DB::table('fee_types')
        ->get()
        ->toArray();
        $payment_records_data = [];
        if($this->filters['search_by'] == 'Student code'){
            if($this->filters['college_id']){
                $payment_records_data = DB::table('payment_items as pi')
                ->select(
                    "pi.id as id",
                    "u.id as user_id",
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
            }else{
                $payment_records_data = DB::table('payment_items as pi')
                ->select(
                    "pi.id as id",
                    "u.id as user_id",
                    "u.first_name as collector_first_name",
                    "u.middle_name as collector_middle_name",
                    "u.last_name as collector_last_name",
                    "u.username as collector_username",
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    "s.first_name as student_first_name",
                    "s.middle_name as student_middle_name",
                    "s.last_name as student_last_name",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
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
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    "s.first_name as student_first_name",
                    "s.middle_name as student_middle_name",
                    "s.last_name as student_last_name",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
            }else{
                $payment_records_data = DB::table('payment_items as pi')
                ->select(
                    "pi.id as id",
                    "u.id as user_id",
                    "u.first_name as collector_first_name",
                    "u.middle_name as collector_middle_name",
                    "u.last_name as collector_last_name",
                    "u.username as collector_username",
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    "s.first_name as student_first_name",
                    "s.middle_name as student_middle_name",
                    "s.last_name as student_last_name",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
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
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    "s.first_name as student_first_name",
                    "s.middle_name as student_middle_name",
                    "s.last_name as student_last_name",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
            }else{
                $payment_records_data = DB::table('payment_items as pi')
                ->select(
                    "pi.id as id",
                    "u.id as user_id",
                    "u.first_name as collector_first_name",
                    "u.middle_name as collector_middle_name",
                    "u.last_name as collector_last_name",
                    "u.username as collector_username",
                    DB::raw('CONCAT(u.first_name," ",u.middle_name," ",u.last_name) as collected_by_fullname'),
                    "u.username as colleted_by_username",
                    "s.id as student_id",
                    "s.student_code as student_code",
                    "s.first_name as student_first_name",
                    "s.middle_name as student_middle_name",
                    "s.last_name as student_last_name",
                    DB::raw('CONCAT(s.first_name," ",s.middle_name," ",s.last_name) as student_fullname'),
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
                ->paginate($this->table_filters['table_max_display']);
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
                'page_info'=>$page_info,
                'fees'=>$fees
            ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function downloadExportDefault($modal_id){
        $this->downloadfilters = $this->filters;
        $this->dispatch('openModal',$modal_id);
    }
    public function downloadExport($modal_id){
        if($this->downloadfilters['college_id']){
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
            ->where('f.school_year_id','like',$this->downloadfilters['school_year_id'] .'%')
            ->where('s.college_id','=',$this->downloadfilters['college_id'])
            ->where('f.fee_type_id','like',$this->downloadfilters['fee_id'] .'%')
            ->orderBy('pi.id','desc')
            ->groupBy('pi.id')
            ->get()
            ->toArray();
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
            ->where('f.school_year_id','like',$this->downloadfilters['school_year_id'] .'%')
            ->where('f.fee_type_id','like',$this->downloadfilters['fee_id'] .'%')
            ->orderBy('pi.id','desc')
            ->groupBy('pi.id')
            ->get()
            ->toArray();
        }

        $college_name_filter = DB::table('colleges')
            ->where('id','=',$this->downloadfilters['college_id'])
            ->first();
        $college_name = NULL;
        if($college_name_filter){
            $college_name = $college_name_filter->name;
        }

        $fee_type = DB::table('fee_types')
            ->where('id','=',$this->downloadfilters['fee_id'])
            ->first();
        $fee_type_name = NULL;
        if($fee_type){
            $fee_type_name = $fee_type->name;
        }
        $page_info = DB::table('users as u')
            ->select(
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
            )
            ->where('u.id','=',$this->user_details->id)
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first();

        
        
        $file_name = 'Payment Records';
        $type = $this->export_selected;
        $header = [
            ['Title'=>  'Payment Records'],
            ['Academic Year'=>  'Academic Year '.$page_info->school_year ],
            ['content'=> $college_name],
            ['content'=> $fee_type_name],
            ['content'=>NULL],
            ['content'=>NULL]
        ];
        $content = [];
        array_push($content,[
            '#',
            'Student Code',
            'Student Name',
            'Fee Type',
            'Fee Code',
            'Fee Name',
            'Amount Collected',
            'Collected By',
            'Collected at',
        ]);
        foreach ($payment_records_data as $key =>$value){
            $content_item = [];          
            array_push($content_item,$key+1);
            array_push($content_item,$value->student_code);
            array_push($content_item,$value->student_first_name. ' ' .$value->student_middle_name.' ' .$value->student_last_name );
            array_push($content_item,$value->fee_type_name);
            array_push($content_item,$value->fee_code);
            array_push($content_item,$value->fee_name);
            array_push($content_item,number_format($value->amount, 2, '.', ','));
            array_push($content_item,$value->collector_first_name. ' ' .$value->collector_middle_name.' ' .$value->collector_last_name);
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
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=> $this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Payment Records '.$type,
                'link' =>'#',
            ]);
            return Excel::download($export, $file_name.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }elseif($type == 'CSV'){
            $export = new ExporterController([
                $header,
                $content
            ]);
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Payment Records '.$type,
                'link' =>'#',
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }elseif($type == 'PDF'){
            $pdf = Pdf::loadView('livewire.csc.export.exportpdf',  array( 
                'header'=>$header,
                'content'=> $content)
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Payment Records '.$type,
                'link' =>'#',
            ]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->setPaper('a4', 'landscape')->stream();
            },  $file_name.'.pdf');
        }else{
            $export = new ExporterController([
                $header,
                $content
            ]);
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Payment Records '.$type,
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
