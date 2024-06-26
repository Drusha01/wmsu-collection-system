<?php

namespace App\Livewire\Csc\Payments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class Payments extends Component
{
    use WithPagination;
    public $title = "Payments";
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'search'=> NULL,
        'search_by' => 'Student code',
        'prev_search'=> NULL,
        'status_search'=> NULL,
        'prev_status_search'=> NULL,
    ];
    public $export_types = [
        0=>['name'=>'EXCEL'],
        1=>['name'=>'CSV'],
        2=>['name'=>'PDF'],

    ];
    public $export_selected = 'PDF';
    public $downloadfilters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'search'=> NULL,
        'search_by' => 'Student code',
        'prev_search'=> NULL,
        'status_search'=> NULL,
        'prev_status_search'=> NULL,
    ];
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Student email',
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
    public function mount(){

    }
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function render()
    {
        $status = DB::table('status')
            ->get()
            ->toArray();
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
        if($this->filters['year_level_id'] != $this->filters['prevyear_level_id']){
            $this->filters['prevyear_level_id'] =$this->filters['year_level_id'];
            $this->resetPage();
        }
        if($this->filters['department_id'] != $this->filters['prevdepartment_id']){
            $this->filters['prevdepartment_id'] =$this->filters['department_id'];
            $this->resetPage();
        }
        if($this->filters['semester_id'] != $this->filters['prevsemester_id']){
            $this->filters['prevsemester_id'] =$this->filters['semester_id'];
            $this->resetPage();
        }
        if($this->filters['status_search'] != $this->filters['prev_status_search']){
            $this->filters['prev_status_search'] =$this->filters['status_search'];
            $this->resetPage();
        }
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

        $enrolled_students_data = [];
        if($this->filters['search_by'] == 'Student code' ){
            $enrolled_students_data = DB::table('students as s')
                ->select(
                    "s.id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    'sm.semester',
                    'sm.id as semester_id',
                    "st.name as payment_status",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    'yl.year_level'
                )
                ->join('enrolled_students as es','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','sm.id','es.semester_id')
                ->join('status as st','st.id','es.payment_status')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=', $this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where('s.student_code','like',$this->filters['search'].'%')
                ->where('st.id','like',$this->filters['status_search'].'%')
                ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student name' ){
            $enrolled_students_data = DB::table('students as s')
                ->select(
                    "s.id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    'sm.semester',
                    'sm.id as semester_id',
                    "st.name as payment_status",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    'yl.year_level'
                )
                ->join('enrolled_students as es','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','sm.id','es.semester_id')
                ->join('status as st','st.id','es.payment_status')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=', $this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->where('st.id','like',$this->filters['status_search'].'%')
                ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student email' ){
            $enrolled_students_data = DB::table('students as s')
                ->select(
                    "s.id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    'sm.semester',
                    'sm.id as semester_id',
                    "st.name as payment_status",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    'yl.year_level'
                )
                ->join('enrolled_students as es','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','sm.id','es.semester_id')
                ->join('status as st','st.id','es.payment_status')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=', $this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where('s.email','like',$this->filters['search'].'%')
                ->where('st.id','like',$this->filters['status_search'].'%')
                ->paginate(10);
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
        return view('livewire.csc.payments.payments',[
            'enrolled_students_data'=>$enrolled_students_data,
            'page_info'=>$page_info,
            'status'=>$status
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function downloadExportDefault($modal_id){
        $this->downloadfilters = $this->filters;
        $this->dispatch('openModal',$modal_id);
    }
    public function downloadExport($modal_id){
        if($this->downloadfilters['department_id']){
            $enrolled_students_data = DB::table('students as s')
            ->select(
                "s.id",
                "s.student_code",
                "s.first_name",
                "s.middle_name",
                "s.last_name",
                "s.email",
                'sm.semester',
                'sm.id as semester_id',
                "st.name as payment_status",
                "c.code as college_code",
                "c.name as college_name",
                "d.name as department_name",
                "d.code as department_code",
                'yl.year_level'
            )
            ->join('enrolled_students as es','es.student_id','s.id')
            ->join('colleges as c','es.college_id','c.id')
            ->join('departments as d','es.department_id','d.id')
            ->join('semesters as sm','sm.id','es.semester_id')
            ->join('status as st','st.id','es.payment_status')
            ->join('year_levels as yl','es.year_level_id','yl.id')
            ->where('es.college_id','=', $this->user_details->college_id)
            ->where('es.year_level_id','like',$this->downloadfilters['year_level_id'].'%')
            ->where('es.department_id','like',$this->downloadfilters['department_id'].'%')
            ->where('es.semester_id','like',$this->downloadfilters['semester_id'].'%')
            ->where('st.id','like',$this->downloadfilters['status_search'].'%')
            ->get()
            ->toArray();
        }else{
            $enrolled_students_data = DB::table('students as s')
            ->select(
                "s.id",
                "s.student_code",
                "s.first_name",
                "s.middle_name",
                "s.last_name",
                "s.email",
                'sm.semester',
                'sm.id as semester_id',
                "st.name as payment_status",
                "c.code as college_code",
                "c.name as college_name",
                "d.name as department_name",
                "d.code as department_code",
                'yl.year_level'
            )
            ->join('enrolled_students as es','es.student_id','s.id')
            ->join('colleges as c','es.college_id','c.id')
            ->join('departments as d','es.department_id','d.id')
            ->join('semesters as sm','sm.id','es.semester_id')
            ->join('status as st','st.id','es.payment_status')
            ->join('year_levels as yl','es.year_level_id','yl.id')
            ->where('es.college_id','=', $this->user_details->college_id)
            ->where('es.year_level_id','like',$this->downloadfilters['year_level_id'].'%')
            ->where('es.semester_id','like',$this->downloadfilters['semester_id'].'%')
            ->where('st.id','like',$this->downloadfilters['status_search'].'%')
            ->get()
            ->toArray();
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
        $current_semester = DB::table('semesters')
            ->where('id','=',$this->downloadfilters['semester_id'])
            ->first();
        $semester = NULL;
        if($current_semester){
            $semester = $current_semester->semester;
        }
        
        $file_name = 'Payments';
        $type = $this->export_selected;
        $header = [
            ['Title'=>  'Payments'],
            ['Academic Year'=>  'Academic Year '.$page_info->school_year ],
            ['content'=> $page_info->college_name],
            ['content'=> $semester],
            ['content'=>NULL],
            ['content'=>NULL]
        ];
        $content = [];
        array_push($content,[
            '#',
            'Student Code',
            'Student Name',
            'Student Email',
            'Department',
            'Semester',
            'Yr. Level',
            'Payment Status',
        ]);
        foreach ($enrolled_students_data as $key =>$value){
            $content_item = [];          
            array_push($content_item,$key+1);
            array_push($content_item,$value->student_code);
            array_push($content_item,$value->first_name. ' ' .$value->middle_name.' ' .$value->last_name );
            array_push($content_item,$value->email);
            array_push($content_item,$value->department_code);
            array_push($content_item,$value->semester);
            array_push($content_item,$value->year_level);
            array_push($content_item,$value->payment_status);
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
                'log_details' =>'has downloaded a Payments '.$type ,
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
                'log_details' =>'has downloaded a Payments '.$type ,
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
                'log_details' =>'has downloaded a Payments '.$type ,
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
                'log_details' =>'has downloaded a Payments '.$type ,
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
