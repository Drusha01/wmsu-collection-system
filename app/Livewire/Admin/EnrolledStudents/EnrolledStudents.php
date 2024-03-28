<?php

namespace App\Livewire\Admin\EnrolledStudents;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class EnrolledStudents extends Component
{
    use WithPagination;
    public $title = "Enrolledstudents";
    public $semesters = [];
    public $year_levels = [];
    public $student_id_search;
    public $prevstudent_id_search;
    public $department_data =[];
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'college_id' => NULL,
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
    public $search_by = [
        0=>'Student code',
        1=>'Student name',
        2=>'Student email',
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
        $this->department_data = DB::table('departments')
        ->get()
        ->toArray();
    }
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] = $this->filters['search'];
            $this->resetPage();
        }
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $colleges_data = DB::table('colleges')
            ->get()
            ->toArray();
        $school_years = DB::table('school_years')
            ->get()
            ->toArray();
      
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();
        $enrolled_students_data = [];
        if($this->filters['search_by'] == 'Student code' ){
            if($this->filters['college_id']){
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
                    ->where('es.college_id','=',$this->filters['college_id'])
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where('s.student_code','like',$this->filters['search'].'%')
                    ->paginate(10);
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
                    ->where('es.college_id','like',$this->filters['college_id'].'%')
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where('s.student_code','like',$this->filters['search'].'%')
                    ->paginate(10);
            }
        }elseif($this->filters['search_by'] == 'Student name' ){
            if($this->filters['college_id']){
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
                    ->where('es.college_id','=',$this->filters['college_id'])
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                    ->paginate(10);
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
                    ->where('es.college_id','like',$this->filters['college_id'].'%')
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where(DB::raw("CONCAT(s.first_name,' ',s.middle_name,' ',s.last_name)"),'like',$this->filters['search'] .'%')
                    ->paginate(10);
            }
        }elseif($this->filters['search_by'] == 'Student email' ){
            if($this->filters['college_id']){
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
                    ->where('es.college_id','=',$this->filters['college_id'])
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where('s.email','like',$this->filters['search'].'%')
                    ->paginate(10);
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
                    ->where('es.college_id','like',$this->filters['college_id'].'%')
                    ->where('es.year_level_id','like',$this->filters['year_level_id'].'%')
                    ->where('es.department_id','like',$this->filters['department_id'].'%')
                    ->where('es.semester_id','like',$this->filters['semester_id'].'%')
                    ->where('s.email','like',$this->filters['search'].'%')
                    ->paginate(10);
            }
        }
       
  
            return view('livewire.admin.enrolled-students.enrolled-students',[
            'colleges_data'=>$colleges_data,
            'enrolled_students_data'=>$enrolled_students_data,
            'school_years'=>$school_years
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
            $this->enrolledStudent['student_id'] = $student->id;
            $this->enrolledStudent['student_name'] = $student->first_name.' '.$student->middle_name.' '.$student->last_name;
            $this->enrolledStudent['college_id'] = $student->college_id;
            $this->enrolledStudent['department_id'] = $student->department_id;
            $this->department_data = DB::table('departments')
            ->where('college_id','=', $student->college_id)
            ->get()
            ->toArray();
        }else{
            $this->enrolledStudent['student_name'] = NULL;
            $this->enrolledStudent['student_name']  = NULL;
            $this->enrolledStudent['college_id']  = NULL;
            $this->enrolledStudent['department_id']  = NULL;
        }
    }
    public function updateDepartments(){
        $this->department_data = DB::table('departments')
        ->where('college_id','=', $this->enrolledStudent['college_id'] )
        ->get()
        ->toArray();
        $this->enrolledStudent['department_id'] = NULL;
    }
    public function saveAddEnrolledStudent($modal_id){
        if(!(DB::table('school_years')
            ->where('id','=',$this->enrolledStudent['school_year_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select school year',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
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
        if(!(DB::table('colleges')
            ->where('id','=',$this->enrolledStudent['college_id'])
            ->first())){
                $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select college',
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
        if(!(DB::table('school_years')
            ->where('id','=',$this->enrolledStudent['school_year_id'])
            ->first())
            ){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select school year',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return ;
        }
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
        if(!(DB::table('colleges')
            ->where('id','=',$this->enrolledStudent['college_id'])
            ->first())){
                $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select college',
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
            
        }
        DB::table('logs')
        ->insert([
            'id' =>NULL,
            'log_type_id' =>1,
            'created_by' =>$this->user_details->id,
            'log_details' =>'has updated an enrolled student ('.$this->enrolledStudent['student_code'].') '.$this->enrolledStudent['student_name'],
            'link' => route('admin-fees'),
        ]);
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
}
