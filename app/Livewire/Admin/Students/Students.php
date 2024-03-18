<?php

namespace App\Livewire\Admin\Students;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;
    public $title = "Students";
    public $student = [
        'id' => NULL,
        'student_code' => NULL,
        'first_name' => NULL,
        'middle_name' => NULL,
        'last_name' => NULL,
        'email' => NULL,
        'is_muslim' => NULL,
        'college_id' => NULL,
        'department_id' => NULL,
    ];
    public $departments = [];

    public function boot(Request $request ){
        $session = $request->session()->all();
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->get()
            ->first()){
            if ($user_details->role_name == 'officer') {
                return redirect()->route('officer-dashboard');
            }else if ($user_details->role_name == 'admin') {

            }elseif($user_details->role_name == 'collector'){
                return redirect()->route('collector-dashboard');
            }
        }else{
            return redirect('/login');
        }
    }
    public function render(){
        $student_data = DB::table('students as s')
            ->select(
                "s.id",
                "student_code",
                "first_name",
                "middle_name",
                "last_name",
                "email",
                "s.college_id",
                "s.department_id",
                "s.date_created",
                "s.date_updated",
                "c.code as college_code",
                "c.name as college_name",
                "d.name as department_name",
                "d.code as department_code",
                's.is_muslim',
                's.is_active'
            )
            ->join('colleges as c','s.college_id','c.id')
            ->join('departments as d','s.department_id','d.id')
            ->paginate(10);
        $colleges_data = DB::table('colleges')
            ->get()
            ->toArray();
        $department_data = DB::table('departments')
            ->where('college_id','=',$this->student['college_id'])
            ->get()
            ->toArray();
        return view('livewire.admin.students.students',
                ['student_data'=>$student_data,
                'colleges_data'=>$colleges_data,
                'department_data'=>$department_data   ])
            ->layout('components.layouts.admin',[
                'title'=>$this->title]);
    }
    public function addStudent($modal_id){
        $this->student = [
            'id' => NULL,
            'student_code' => NULL,
            'first_name' => NULL,
            'middle_name' => NULL,
            'last_name' => NULL,
            'email' => NULL,
            'is_muslim' => NULL,
            'college_id' => NULL,
            'department_id' => NULL,
        ];
        $this->dispatch('openModal',$modal_id);

    }
    public function updateDepartments(){
        if(($this->student['college_id'] > 0 && DB::table('colleges')
            ->where('id','=',$this->student['college_id'])
            ->where('is_active','=',1)
            ->get()
            ->first())){
                $this->student['department_id'] = NULL;
            // $this->departments = DB::table('departments')
            //     ->where('college_id','=',$this->student['college_id'])
            //     ->get()
            //     ->toArray();
        }
    }
    public function saveAddStudent($modal_id){
        if(!($this->student['college_id'] > 0 && DB::table('colleges')
            ->where('id','=',$this->student['college_id'])
            ->where('is_active','=',1)
            ->get()
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select college!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!($this->student['department_id'] > 0 && DB::table('departments')
            ->where('id','=',$this->student['department_id'])
            ->where('is_active','=',1)
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select course!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if((strlen($this->student['student_code']) > 0 && DB::table('students')
            ->where('student_code','=',$this->student['student_code'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Student code exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if((strlen($this->student['email']) > 0 && DB::table('students')
        ->where('email','=',$this->student['email'])
        ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Student email exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->student['first_name']) <= 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input firstname!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->student['last_name']) <= 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input lastname!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('students')
            ->insert([
                'student_code' => $this->student['student_code'],
                'first_name' => $this->student['first_name'],
                'middle_name' => $this->student['middle_name'],
                'last_name' => $this->student['last_name'],
                'email' => $this->student['email'],
                'is_muslim' =>  $this->student['is_muslim'],
                'college_id' => $this->student['college_id'],
                'department_id' => $this->student['department_id'],
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->dispatch('closeModal',$modal_id);
        }
    }
    public function editStudent($id,$modal_id){

        $student = DB::table('students as s')
        ->select(
            "s.id",
            "student_code",
            "first_name",
            "middle_name",
            "last_name",
            "email",
            "s.college_id",
            "s.department_id",
            "s.date_created",
            "s.date_updated",
            "c.code as college_code",
            "c.name as college_name",
            "d.name as department_name",
            "d.code as department_code",
            's.is_muslim'
        )
        ->join('colleges as c','s.college_id','c.id')
        ->join('departments as d','s.department_id','d.id')
        ->where('s.id','=',$id)
        ->first();

        $this->student = [
            'id' => $student->id,
            'student_code' => $student->student_code,
            'first_name' => $student->first_name,
            'middle_name' => $student->middle_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'is_muslim'=> $student->is_muslim,
            'college_id' => $student->college_id,
            'department_id' => 2,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function saveEditStudent($id,$modal_id){
        if(!($this->student['college_id'] > 0 && DB::table('colleges')
            ->where('id','=',$this->student['college_id'])
            ->where('is_active','=',1)
            ->get()
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select college!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!($this->student['department_id'] > 0 && DB::table('departments')
            ->where('id','=',$this->student['department_id'])
            ->where('is_active','=',1)
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select course!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if((strlen($this->student['student_code']) > 0 && DB::table('students')
            ->where('id','<>',$this->student['id'])
            ->where('student_code','=',$this->student['student_code'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Student code exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if((strlen($this->student['email']) > 0 && DB::table('students')
        ->where('email','=',$this->student['email'])
        ->where('id','<>',$this->student['id'])
        ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Student email exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->student['first_name']) <= 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input firstname!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(strlen($this->student['last_name']) <= 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input lastname!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('students')
            ->where('id','=',$this->student['id'])
            ->update([
                'student_code' => $this->student['student_code'],
                'first_name' => $this->student['first_name'],
                'middle_name' => $this->student['middle_name'],
                'last_name' => $this->student['last_name'],
                'email' => $this->student['email'],
                'college_id' => $this->student['college_id'],
                'department_id' => $this->student['department_id'],
            ])){
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
    }
    public function saveDeleteStudent($id,$modal_id){
        if(DB::table('students')
            ->where('id','=',$this->student['id'])
            ->update([
                'is_active' => 0
            ])){
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
    }
    public function saveActivateStudent($id,$modal_id){
        if(DB::table('students')
            ->where('id','=',$this->student['id'])
            ->update([
                'is_active' => 1
            ])){
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
    }
}
