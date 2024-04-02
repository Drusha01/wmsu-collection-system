<?php

namespace App\Livewire\Csc\Enrolledstudents;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use App\Http\Controllers\import\importController as ImportController;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Enrolledstudents extends Component
{
    use WithPagination;

    public $title = "Enrolledstudents";
    public $semesters = [];
    public $year_levels = [];
    public $student_id_search;
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Student email',
    ];
    public $enrolledstudents_csv = [
        'csv_path' => NULL,
        'default_header'=>NULL,
        'header' => NULL,
        'content' => NULL,
    ];
    public $default_header =  [
        'Student Code (*)',
        'Year Level (*)',
        'Semester (*)',
        'College code (*)',
        'Department Code (*)'
    ];
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'search'=> NULL,
        'search_by' => 'Student code',
        'prev_search'=> NULL,
    ];
    public $enrolledStudent = [
        'id' => NULL,
        'student_id' => NULL,
        'student_code' => NULL,
        'student_name' => NULL,
        'school_year_id' => NULL,
        'semester_id' => NULL,
        'college_id' => NULL,
        'department_id' => NULL,
        'year_level_id' => NULL,
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
    public $export_selected = 'PDF';
    public $downloadfilters = NULL;
    public $export_types = [
        0=>['name'=>'EXCEL'],
        1=>['name'=>'CSV'],
        2=>['name'=>'PDF'],

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
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function mount(){
        $this->downloadfilters = $this->filters;
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $colleges_data = DB::table('colleges')
            ->where('id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
        $department_data = DB::table('departments')
            ->where('college_id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();
        $enrolled_students_data = [];
        if($this->filters['search_by'] == 'Student code' ){
            $enrolled_students_data = DB::table('enrolled_students as es')
                ->select(
                    "es.id",
                    "s.id as student_id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    "es.college_id",
                    "es.department_id",
                    "es.date_created",
                    "es.date_updated",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    's.is_muslim',
                    's.is_active',
                    'sm.semester',
                    'sy.year_start',
                    'sy.year_end',
                    'yl.year_level'
                )
                ->join('students as s','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','es.semester_id','sm.id')
                ->join('school_years as sy','es.school_year_id','sy.id')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=',$this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where('s.student_code','like',$this->filters['search'] .'%')
                ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student name' ){
            $enrolled_students_data = DB::table('enrolled_students as es')
                ->select(
                    "es.id",
                    "s.id as student_id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    "es.college_id",
                    "es.department_id",
                    "es.date_created",
                    "es.date_updated",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    's.is_muslim',
                    's.is_active',
                    'sm.semester',
                    'sy.year_start',
                    'sy.year_end',
                    'yl.year_level'
                )
                ->join('students as s','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','es.semester_id','sm.id')
                ->join('school_years as sy','es.school_year_id','sy.id')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=',$this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                ->paginate(10);
        }elseif($this->filters['search_by'] == 'Student email' ){
            $enrolled_students_data = DB::table('enrolled_students as es')
                ->select(
                    "es.id",
                    "s.id as student_id",
                    "s.student_code",
                    "s.first_name",
                    "s.middle_name",
                    "s.last_name",
                    "s.email",
                    "es.college_id",
                    "es.department_id",
                    "es.date_created",
                    "es.date_updated",
                    "c.code as college_code",
                    "c.name as college_name",
                    "d.name as department_name",
                    "d.code as department_code",
                    's.is_muslim',
                    's.is_active',
                    'sm.semester',
                    'sy.year_start',
                    'sy.year_end',
                    'yl.year_level'
                )
                ->join('students as s','es.student_id','s.id')
                ->join('colleges as c','es.college_id','c.id')
                ->join('departments as d','es.department_id','d.id')
                ->join('semesters as sm','es.semester_id','sm.id')
                ->join('school_years as sy','es.school_year_id','sy.id')
                ->join('year_levels as yl','es.year_level_id','yl.id')
                ->where('es.college_id','=',$this->user_details->college_id)
                ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                ->where('es.department_id','like',$this->filters['department_id'].'%')
                ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                ->where('s.email','like',$this->filters['search'] .'%')
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
        return view('livewire.csc.enrolledstudents.enrolledstudents',[
            'colleges_data'=>$colleges_data,
            'department_data'=>$department_data,
            'enrolled_students_data'=>$enrolled_students_data,
            'page_info'=>$page_info
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addEnrolledStudents($modal_id){
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();
           
        $this->enrolledStudent = [
            'id' => NULL,
            'student_id' => NULL,
            'student_code' => NULL,
            'student_name' => NULL,
            'school_year_id' => $this->user_details->school_year_id,
            'semester_id' => NULL,
            'college_id' => $this->user_details->college_id,
            'department_id' => NULL,
            'year_level_id' => NULL,
        ];

        $this->dispatch('openModal',$modal_id);
    }
    public function updateStudentName(){
        $student = DB::table('students')
            ->where('student_code','=',$this->enrolledStudent['student_code'])
            ->first();
        if($student){
            if($student->college_id != $this->user_details->college_id){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Student college record doesn\'t match!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
            }
            $this->enrolledStudent['student_id'] = $student->id;
            $this->enrolledStudent['student_name'] = $student->first_name.' '.$student->middle_name.' '.$student->last_name;
            $this->enrolledStudent['college_id'] = $student->college_id;
            $this->enrolledStudent['department_id'] = $student->department_id;
        }else{
            $this->enrolledStudent['student_name'] = NULL;
            $this->enrolledStudent['student_name']  = NULL;
            $this->enrolledStudent['college_id']  = NULL;
            $this->enrolledStudent['department_id']  = NULL;
        }
    }
    public function saveAddEnrolledStudent($modal_id){
        if(!(DB::table('year_levels')
            ->where('id','=',$this->enrolledStudent['year_level_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select year level',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
        if(!(DB::table('semesters')
            ->where('id','=',$this->enrolledStudent['semester_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
        if(!(DB::table('students')
            ->where('id','=',$this->enrolledStudent['student_id'])
            ->first())){
                $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid student code',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!(DB::table('departments')
            ->where('id','=',$this->enrolledStudent['department_id'])
            ->first())){
                $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select department',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('enrolled_students')
            ->where('student_id','=',$this->enrolledStudent['student_id'])
            ->where('school_year_id','=',$this->enrolledStudent['school_year_id'])
            ->where('semester_id','=',$this->enrolledStudent['semester_id'])
            ->first()
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Student is already enrolled in that year and semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
        if(DB::table('enrolled_students')
            ->insert([
                    'student_id' => $this->enrolledStudent['student_id'],
                    'school_year_id' => $this->enrolledStudent['school_year_id'],
                    'semester_id' => $this->enrolledStudent['semester_id'],
                    'college_id' => $this->enrolledStudent['college_id'],
                    'department_id' => $this->enrolledStudent['department_id'],
                    'year_level_id' => $this->enrolledStudent['year_level_id'],
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
                    'log_details' =>'has added an enrolled student ('.$this->enrolledStudent['student_code'].') '.$this->enrolledStudent['student_name'],
                    'link' => route('admin-fees'),
                ]);
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
    public function editEnrolledStudents($id,$modal_id){
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();
        
        $enrolledStudent = DB::table('enrolled_students as es')
            ->select(
                'es.id',
                'es.student_id',
                's.first_name',
                's.middle_name',
                's.last_name',
                's.student_code',
                'es.school_year_id' ,
                'es.semester_id' ,
                'es.college_id' ,
                'es.department_id' ,
                'es.year_level_id' 
            )
            ->join('students as s','es.student_id','s.id')
            ->where('es.id','=',$id)
            ->get()
            ->first();
        $this->enrolledStudent = [
            'id' =>  $enrolledStudent->id,
            'student_id' => $enrolledStudent->student_id,
            'student_code' => $enrolledStudent->student_code,
            'student_name' =>  $enrolledStudent->first_name.' '. $enrolledStudent->middle_name.' '. $enrolledStudent->last_name,
            'school_year_id' => $enrolledStudent->school_year_id,
            'semester_id' => $enrolledStudent->semester_id,
            'college_id' => $enrolledStudent->college_id,
            'department_id' => $enrolledStudent->department_id,
            'year_level_id' => $enrolledStudent->year_level_id,
        ];

        $this->dispatch('openModal',$modal_id);
    }

    public function saveEditEnrolledStudent($id,$modal_id){
        if(!(DB::table('year_levels')
            ->where('id','=',$this->enrolledStudent['year_level_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select year level',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
        if(!(DB::table('semesters')
            ->where('id','=',$this->enrolledStudent['semester_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
        if(!(DB::table('students')
        ->where('id','=',$this->enrolledStudent['student_id'])
        ->first())){
            $this->dispatch('swal:redirect',
            position         									: 'center',
            icon              									: 'warning',
            title             									: 'Invalid student code',
            showConfirmButton 									: 'true',
            timer             									: '1000',
            link              									: '#'
        );
        return;
    }
    if(!(DB::table('departments')
        ->where('id','=',$this->enrolledStudent['department_id'])
        ->first())){
            $this->dispatch('swal:redirect',
            position         									: 'center',
            icon              									: 'warning',
            title             									: 'Please select department',
            showConfirmButton 									: 'true',
            timer             									: '1000',
            link              									: '#'
        );
        return;
    }
        if(DB::table('enrolled_students')
            ->where('id','=',$this->enrolledStudent['student_id'])
            ->where('school_year_id','=',$this->enrolledStudent['school_year_id'])
            ->where('semester_id','=',$this->enrolledStudent['semester_id'])
            ->first()
            ){
            DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>1,
                    'created_by' =>$this->user_details->id,
                    'log_details' =>'has updated an enrolled student ('.$this->enrolledStudent['student_code'].') '.$this->enrolledStudent['student_name'],
                    'link' => route('admin-fees'),
                ]);
        }else{
            if(DB::table('enrolled_students as es')
                ->where('es.id','=',$id)
                ->update([
                        'student_id' => $this->enrolledStudent['student_id'],
                        'school_year_id' => $this->enrolledStudent['school_year_id'],
                        'semester_id' => $this->enrolledStudent['semester_id'],
                        'college_id' => $this->enrolledStudent['college_id'],
                        'department_id' => $this->enrolledStudent['department_id'],
                        'year_level_id' => $this->enrolledStudent['year_level_id'],
                    ])){
                DB::table('logs')
                    ->insert([
                        'id' =>NULL,
                        'log_type_id' =>1,
                        'created_by' =>$this->user_details->id,
                        'log_details' =>'has updated an enrolled student ('.$this->enrolledStudent['student_code'].') '.$this->enrolledStudent['student_name'],
                        'link' => route('admin-fees'),
                    ]);
            }
        }
        $this->dispatch('swal:redirect',
            position         									: 'center',
            icon              									: 'success',
            title             									: 'Successfully updated',
            showConfirmButton 									: 'true',
            timer             									: '1000',
            link              									: '#'
        );
        $this->dispatch('closeModal',$modal_id);
    }
    public function saveDeleteEnrolledStudent($id,$modal_id){
        if(DB::table('enrolled_students as es')
            ->where('es.id','=',$id)
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
                    'log_details' =>'has deleted an enrolled student ('.$this->enrolledStudent['student_code'].') '.$this->enrolledStudent['student_name'],
                    'link' => route('admin-fees'),
                ]);
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
    public function downloadTemplate(){
        $file_name = 'EnrolledStudentImportTemplate';
        $header = [];
        $content = [];
        array_push($content, $this->default_header);
        $export = new ExporterController([
            $header,
            $content
        ]);
        return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function ImportEnrolledStudents($modal_id){
        $this->enrolledstudents_csv =[
            'csv_path' => NULL,
            'default_header'=>NULL,
            'header' => NULL,
            'content' => NULL,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function checkUpload(){
        $csv_path = storage_path().'\\app\\import\\enrolledstudents\\'.$this->user_details->id.'\\enrolledstudents.csv';
        $delay_count = 0;
        while(!file_exists($csv_path)){
            sleep(1);
            if($delay_count>=10){
                if(file_exists($csv_path)){
                    unlink( $csv_path);
                }
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Unsuccessfully upload!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                $this->enrolledstudents_csv['content'] = NULL;
                return;
            }
        }
        self::validate_enrolled_student_csv($csv_path);
        if(file_exists($csv_path)){
            unlink( $csv_path);
        }
        if($this->enrolledstudents_csv['header']){
            foreach ($this->enrolledstudents_csv['header'] as $key => $value) {
                if($this->enrolledstudents_csv['default_header'][$key] != $this->enrolledstudents_csv['header'][$key]){
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'warning',
                        title             									: 'Invalid header at column '.($key+1). ' column name ('.$this->enrolledstudents_csv['header'][$key].'). Please download the right template!',
                        showConfirmButton 									: 'true',
                        timer             									: '2500',
                        link              									: '#'
                    );
                    $this->enrolledstudents_csv['content'] = NULL;
                    return;
                }
            }
        }
        if($this->enrolledstudents_csv['content']){
            foreach ($this->enrolledstudents_csv['content'] as $key => $value) {
                foreach ($this->enrolledstudents_csv['default_header'] as $header_key => $header_value) {
                    if(substr($header_value,strlen($header_value)-3) == '(*)'){
                        if(!isset($value[$header_key])){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'No student info at row '.($key+1). ' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '2500',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                        if(isset($value[$header_key]) && strlen($value[$header_key])<=0){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'Invalid student info at row '.($key+1). ' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '2500',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }
                }
            }
            foreach ($this->enrolledstudents_csv['content'] as $key => $value) {
                foreach ($this->enrolledstudents_csv['default_header'] as $header_key => $header_value) {
                    if($header_value  == 'Student Code (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(!($student = DB::table('students')
                        ->where('student_code','=',$value[$header_key])
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'Student code doesn\'t exist at Students Module at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }elseif($header_value  == 'School Year (*)'){
                    }elseif($header_value  == 'Year Level (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(intval($value[$header_key]) >= 1 && intval($value[$header_key]) <= 2 ){

                        }else{
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column be 1 - 2 only, it refers to 1st semester - 2nd semester, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }elseif($header_value  == 'Semester (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(intval($value[$header_key]) == 1 || intval($value[$header_key]) == 2 ){

                        }else{
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' Semester must be 1 - 2 only, it refers to 1st semester - 2nd semester, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }elseif($header_value  == 'College code (*)'){
                        if(! ($college = DB::table('colleges')
                        ->where('code','=',$value[$header_key])
                        ->where('is_active','=',1)
                        ->get()
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column must be a code from College Module, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }elseif($header_value  == 'Department Code (*)'){
                        if($college && isset($value[$header_key]) &&  !($department = DB::table('departments')
                        ->where('code','=',$value[$header_key])
                        ->where('college_id','=',$college->id)
                        ->where('is_active','=',1)
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column must be a code from College Module > Departments, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }
                }
            }

        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'No students to be imported!',
                showConfirmButton 									: 'true',
                timer             									: '2500',
                link              									: '#'
            );
            $this->enrolledstudents_csv['content'] = NULL;
            return;
        }
    }
    public function validate_enrolled_student_csv($path){
        $rows = array_map('str_getcsv', file($path));
        $header =[];
        $content =[];
        $item = [];
        foreach ($rows as $key => $value) {
            // validate
            if($key == 0){
                foreach ($value as $key => $item_value) {
                    array_push( $header,$item_value);
                }
            }else{
                $item = [];
                foreach ($value as $key => $item_value) {
                    array_push( $item,$item_value);
                }
                array_push( $content,$item);
            }
        }
        $this->enrolledstudents_csv = [
            'input_id' => rand(),
            'csv_path' => $path,
            'default_header'=> $this->default_header,
            'header' => $header,
            'content' => $content,
        ];
    }
    public function importEnrolledStudentCSV($modal_id){
        if($this->enrolledstudents_csv['header']){
            foreach ($this->enrolledstudents_csv['header'] as $key => $value) {
                if($this->enrolledstudents_csv['default_header'][$key] != $this->enrolledstudents_csv['header'][$key]){
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'warning',
                        title             									: 'Invalid header at column '.($key+1). ' column name ('.$this->enrolledstudents_csv['header'][$key].'). Please download the right template!',
                        showConfirmButton 									: 'true',
                        timer             									: '2500',
                        link              									: '#'
                    );
                    $this->enrolledstudents_csv['content'] = NULL;
                    return;
                }
            }
        }
        if($this->enrolledstudents_csv['content']){
            foreach ($this->enrolledstudents_csv['content'] as $key => $value) {
                foreach ($this->enrolledstudents_csv['default_header'] as $header_key => $header_value) {
                    if(substr($header_value,strlen($header_value)-3) == '(*)'){
                        if(!isset($value[$header_key])){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'No student info at row '.($key+1). ' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '2500',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                        if(isset($value[$header_key]) && strlen($value[$header_key])<=0){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'Invalid student info at row '.($key+1). ' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '2500',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }
                }
            }
            foreach ($this->enrolledstudents_csv['content'] as $key => $value) {
                foreach ($this->enrolledstudents_csv['default_header'] as $header_key => $header_value) {
                    if($header_value  == 'Student Code (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(!($student = DB::table('students')
                        ->where('student_code','=',$value[$header_key])
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: 'Student code doesn\'t exist at Students Module at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                        $this->enrolledstudents_csv['content'][$key][$header_key] = $student->id;
                        
                    }elseif($header_value  == 'School Year (*)'){
                    }elseif($header_value  == 'Year Level (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(intval($value[$header_key]) >= 1 && intval($value[$header_key]) <= 2 ){

                        }else{
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column be 1 - 2 only, it refers to 1st semester - 2nd semester, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            $this->enrolledstudents_csv['content'] = NULL;
                            return;
                        }
                    }elseif($header_value  == 'Semester (*)'){
                        $value[$header_key] = str_replace(' ', '', $value[$header_key]);
                        if(intval($value[$header_key]) == 1 || intval($value[$header_key]) == 2 ){

                        }else{
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' Semester must be 1 - 2 only, it refers to 1st semester - 2nd semester, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            return;
                        }
                    }elseif($header_value  == 'College code (*)'){
                        if(! ($college = DB::table('colleges')
                        ->where('code','=',$value[$header_key])
                        ->where('is_active','=',1)
                        ->get()
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column must be a code from College Module, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            return;
                        }
                        $this->enrolledstudents_csv['content'][$key][$header_key] = $college->id;
                    }elseif($header_value  == 'Department Code (*)'){
                        if($college && isset($value[$header_key]) &&  !($department = DB::table('departments')
                        ->where('code','=',$value[$header_key])
                        ->where('college_id','=',$college->id)
                        ->where('is_active','=',1)
                        ->first())){
                            $this->dispatch('swal:redirect',
                                position         									: 'center',
                                icon              									: 'warning',
                                title             									: $header_value.' column must be a code from College Module > Departments, it has a different value at row '.($key+1).' column '.($header_key+1),
                                showConfirmButton 									: 'true',
                                timer             									: '3000',
                                link              									: '#'
                            );
                            return;
                        }
                        $this->enrolledstudents_csv['content'][$key][$header_key] = $department->id;
                    }
                }
            }

        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'No students to be imported!',
                showConfirmButton 									: 'true',
                timer             									: '2500',
                link              									: '#'
            );
            $this->enrolledstudents_csv['content'] = NULL;
            return;
        }
        foreach ($this->enrolledstudents_csv['content'] as $key => $value) {
            DB::table('enrolled_students')
            ->insert([
                    'student_id' => $value[0],
                    'school_year_id' =>   $this->user_details->school_year_id,
                    'year_level_id' => $value[1],
                    'semester_id' => $value[2],
                    'college_id' => $value[3],
                    'department_id' => $value[4],
            ]);
            $student = DB::table('students')
            ->where('id','=',$value[0])
            ->first();
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has added an enrolled student ('.$student->student_code.') '.$student->first_name.' '.$student->middle_name.' '.$student->last_name,
                'link' => route('admin-enrolledstudents'),
            ]);
        }
        $this->enrolledstudents_csv = [
            'csv_path' => NULL,
            'default_header'=>NULL,
            'header' => NULL,
            'content' => NULL,
        ];
        $this->dispatch('swal:redirect',
            position         									: 'center',
            icon              									: 'success',
            title             									: 'Successfully Imported',
            showConfirmButton 									: 'true',
            timer             									: '1000',
            link              									: '#'
        );
        $this->dispatch('closeModal',$modal_id);
        return;
    }
    public function downloadExportDefault($modal_id){
        $this->downloadfilters = $this->filters;
        $this->dispatch('openModal',$modal_id);
    }
    public function downloadExport($modal_id){
        if($this->downloadfilters['department_id']){
            $enrolled_students_data = DB::table('enrolled_students as es')
            ->select(
                "es.id",
                "s.id as student_id",
                "s.student_code",
                "s.first_name",
                "s.middle_name",
                "s.last_name",
                "s.email",
                "es.college_id",
                "es.department_id",
                "es.date_created",
                "es.date_updated",
                "c.code as college_code",
                "c.name as college_name",
                "d.name as department_name",
                "d.code as department_code",
                's.is_muslim',
                's.is_active',
                'sm.semester',
                'sy.year_start',
                'sy.year_end',
                'yl.year_level'
            )
            ->join('students as s','es.student_id','s.id')
            ->join('colleges as c','es.college_id','c.id')
            ->join('departments as d','es.department_id','d.id')
            ->join('semesters as sm','es.semester_id','sm.id')
            ->join('school_years as sy','es.school_year_id','sy.id')
            ->join('year_levels as yl','es.year_level_id','yl.id')
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('es.year_level_id','like',$this->downloadfilters['year_level_id'].'%')
            ->where('es.department_id','like',$this->downloadfilters['department_id'].'%')
            ->where('es.semester_id','like',$this->downloadfilters['semester_id'].'%')
            ->get()
            ->toArray();
        }else{
            $enrolled_students_data = DB::table('enrolled_students as es')
            ->select(
                "es.id",
                "s.id as student_id",
                "s.student_code",
                "s.first_name",
                "s.middle_name",
                "s.last_name",
                "s.email",
                "es.college_id",
                "es.department_id",
                "es.date_created",
                "es.date_updated",
                "c.code as college_code",
                "c.name as college_name",
                "d.name as department_name",
                "d.code as department_code",
                's.is_muslim',
                's.is_active',
                'sm.semester',
                'sy.year_start',
                'sy.year_end',
                'yl.year_level'
            )
            ->join('students as s','es.student_id','s.id')
            ->join('colleges as c','es.college_id','c.id')
            ->join('departments as d','es.department_id','d.id')
            ->join('semesters as sm','es.semester_id','sm.id')
            ->join('school_years as sy','es.school_year_id','sy.id')
            ->join('year_levels as yl','es.year_level_id','yl.id')
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('es.year_level_id','like',$this->downloadfilters['year_level_id'].'%')
            ->where('es.department_id','like',$this->downloadfilters['department_id'].'%')
            ->where('es.semester_id','like',$this->downloadfilters['semester_id'].'%')
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
        
        $file_name = 'Enrolled Students';
        $type = $this->export_selected;
        $header = [
            ['Title'=>  'Enrolled Students'],
            ['Academic Year'=>  'Academic Year '.$page_info->school_year ],
            ['content'=> $page_info->college_name],
            ['content'=> $semester],
            ['content'=>NULL],
            ['content'=>NULL]
        ];
        $content = [];
        array_push($content,[
            '#',
            'Student ID',
            'Student Name',
            'Student Email',
            'College',
            'Course',
            'S.Y.',
            'Semester',
            'Yr. Level',
        ]);
        foreach ($enrolled_students_data as $key =>$value){
            $content_item = [];          
            array_push($content_item,$key+1);
            array_push($content_item,$value->student_code);
            array_push($content_item,$value->first_name. ' ' .$value->middle_name.' ' .$value->last_name );
            array_push($content_item,$value->email);
            array_push($content_item,$value->college_code);
            array_push($content_item,$value->department_code);
            array_push($content_item,$value->year_start.' - '.$value->year_end);
            array_push($content_item,$value->semester);
            array_push($content_item,$value->year_level);
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
                'log_details' =>'has downloaded a Enrolled Students '.$type ,
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
                'log_details' =>'has downloaded a Enrolled Students '.$type ,
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
                'log_details' =>'has downloaded a Enrolled Students '.$type ,
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
                'log_details' =>'has downloaded a Enrolled Students '.$type ,
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
