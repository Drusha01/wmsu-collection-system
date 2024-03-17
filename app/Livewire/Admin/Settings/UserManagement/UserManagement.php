<?php

namespace App\Livewire\Admin\Settings\UserManagement;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;
    public $title = "User Management";

    public $user = [
        'id' =>NULL,
        'first_name' =>NULL,
        'middle_name' =>NULL,
        'last_name' =>NULL,
        'username' =>NULL,
        'password' =>NULL,
        'college_id' =>NULL,
        'school_year_id' =>NULL,
        'role_id' =>NULL,
        'role_name' => 'usc-admin',
        'position_id' =>NULL,
    ];
    public $school_years = [];
    public $colleges = [];
    public $roles = [];
    public $positions = [];
    public $user_details;
    public function boot(Request $request ){
        $session = $request->session()->all();
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name',
                'p.name as position_name',
                'is_active',
                'u.college_id'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->leftjoin('positions as p','p.id','u.position_id')
            ->get()
            ->first()){
            $this->user_details = $user_details;
            if($user_details->is_active == 1){
                if($user_details->role_name == 'admin') {

                }else{
                    return redirect()->route('/');
                }
            }else{
                return redirect('/login');
            }
        }else{
            return redirect()->route('disabled-account');
        }
    }
    public function render(){
        $users_data = [];
      
        $users_data = DB::table('users as u')
            ->select(
                "u.id",
                "u.first_name",
                "u.middle_name",
                "u.last_name",
                "u.username",
                "u.is_active",
                "u.college_id",
                "u.role_id",
                "u.position_id",
                "u.date_created",
                "u.date_updated",
                
                "r.name as role_name",
                "c.name as college_name",
                "p.name as position_name",
                'u.school_year_id',
                'sy.year_start',
                'sy.year_end',
            )
            ->join('roles as r','r.id','u.role_id')
            ->leftjoin('colleges as c','c.id','u.college_id')
            ->leftjoin('school_years as sy','sy.id','u.school_year_id')
            ->join('positions as p','p.id','u.position_id')
            ->where('r.name','<>','admin')
            ->orderBy('u.date_created')
            ->paginate(10);
       
        return view('livewire.admin.settings.user-management.user-management',[
            'users_data'=>$users_data])
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }

    public function updateRole(){
        $this->user['position_id'] = NULL;
        $this->user['college_id'] = NULL;
        foreach ($this->roles as $key => $value) {
            if( $value->id == $this->user['role_id']){
                $this->user['role_name'] = $value->name;
                if($this->user['role_name'] == 'usc-admin'){
                    $this->positions = DB::table('positions')
                        ->where('role_id','=',$this->user['role_id'])
                        ->get()
                        ->toArray();
                }elseif($this->user['role_name'] == 'csc-admin'){
                    $this->colleges = DB::table('colleges')
                        ->where('is_active','=',1)
                        ->get()
                        ->toArray();
                    $this->positions = DB::table('positions')
                        ->where('role_id','=',$this->user['role_id'])
                        ->get()
                        ->toArray();
                }
            }
        }
    }
    public function addUser($modal_id){
        $this->user = [
            'id' =>NULL,
            'first_name' =>NULL,
            'middle_name' =>NULL,
            'last_name' =>NULL,
            'username' =>NULL,
            'password' =>NULL,
            'college_id' =>NULL,
            'school_year_id' =>NULL,
            'role_id' =>NULL,
            'role_name' => 'usc-admin',
            'position_id' =>NULL,
        ];
       
        $this->roles = DB::table('roles')
            ->where('name','<>','admin')
            ->orderBy('id')
            ->get()
            ->toArray();
        $this->school_years = DB::table('school_years')
            ->get()
            ->toArray();
        if($this->user['role_name'] == 'usc-admin'){
            $this->positions = DB::table('positions')
                ->where('role_id','=',$this->user['role_id'])
                ->get()
                ->toArray();
        }elseif($this->user['role_name'] == 'csc-admin'){
            $this->colleges = DB::table('colleges')
                ->where('is_active','=',1)
                ->get()
                ->toArray();
            $this->positions = DB::table('positions')
                ->where('role_id','=',$this->user['role_id'])
                ->get()
                ->toArray();
        }
       

       
        $this->dispatch('openModal',$modal_id);
    }
    public function saveAddUser($modal_id){
        if(strlen($this->user['first_name'])<=0){
            return;
        }
        if(strlen($this->user['last_name'])<=0){
            return;
        }
        if(strlen($this->user['username'])<3){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Username must be at least 3 character!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }else{
            if(DB::table('users')
                ->where('username','=',$this->user['username'])
                ->first()){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Username exist!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
        }
        if(strlen($this->user['password'])<8){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Password must be at least 8 character!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(intval($this->user['role_id'])<0){
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
        if(!($role = DB::table('roles')
            ->where('id','=',$this->user['role_id'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select role!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($role->name  == 'usc-admin'){
            if(intval($this->user['position_id'])<0){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
            if(!(DB::table('positions')
                ->where('id','=',$this->user['position_id'])
                ->first())){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
        }elseif($role->name  == 'csc-admin'){
            if(intval($this->user['position_id'])<0){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
            if(!(DB::table('positions')
                ->where('id','=',$this->user['position_id'])
                ->first())){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }

            if(intval($this->user['college_id'])<0){
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
            if(!(DB::table('colleges')
                ->where('id','=',$this->user['college_id'])
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
        }
        
        if(DB::table('users')
            ->insert([
                'first_name' =>$this->user['first_name'],
                'middle_name' =>$this->user['middle_name'],
                'last_name' =>$this->user['last_name'],
                'username' =>$this->user['username'],
                'password' =>bcrypt($this->user['password']),
                'school_year_id' =>$this->user['school_year_id'],
                'college_id' =>$this->user['college_id'],
                'role_id' =>$this->user['role_id'],
                'position_id' =>$this->user['position_id']
                ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->user = [
                'id' =>NULL,
                'first_name' =>NULL,
                'middle_name' =>NULL,
                'last_name' =>NULL,
                'username' =>NULL,
                'password' =>NULL,
                'college_id' =>NULL,
                'school_year_id' =>NULL,
                'role_id' =>NULL,
                'role_name' => 'usc-admin',
                'position_id' =>NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Unsuccessfully added!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        
    }
    public function editUser($id,$modal_id){
        $user = DB::table('users as u')
        ->select(
            "u.id",
            "u.first_name",
            "u.middle_name",
            "u.last_name",
            "u.username",
            "u.is_active",
            "u.college_id",
            "u.role_id",
            "u.position_id",
            "u.date_created",
            "u.date_updated",
            "r.name as role_name",
            "c.name as college_name",
            "p.name as position_name",
            'u.school_year_id',
            'sy.year_start',
            'sy.year_end',
        )
        ->join('roles as r','r.id','u.role_id')
        ->leftjoin('colleges as c','c.id','u.college_id')
        ->leftjoin('school_years as sy','sy.id','u.school_year_id')
        ->join('positions as p','p.id','u.position_id')
        ->where('u.id','=',$id)
        ->first();
        $this->user = [
            'id' => $user->id,
            'first_name' =>$user->first_name,
            'middle_name' =>$user->middle_name,
            'last_name' =>$user->last_name,
            'username' =>$user->username,
            'school_year_id' =>$user->school_year_id,
            'sy.year_start' =>$user->year_start,
            'sy.year_end' =>$user->year_end,
            'college_id' =>$user->college_id,
            'role_id' =>$user->role_id,
            'role_name' =>$user->role_name,
            'position_id' =>$user->position_id,
        ];

        $this->school_years = DB::table('school_years')
        ->get()
        ->toArray();

        $this->positions = DB::table('positions')
            ->where('role_id','=',$user->role_id)
            ->get()
            ->toArray();
        $this->colleges = DB::table('colleges')
            ->where('is_active','=',1)
            ->get()
            ->toArray();
        $this->roles = DB::table('roles')
            ->where('name','<>','admin')
            ->orderBy('id')
            ->get()
            ->toArray();
        $this->dispatch('openModal',$modal_id);
    }

    public function saveEditUser($id,$modal_id){
        if(strlen($this->user['first_name'])<=0){
            return;
        }
        if(strlen($this->user['last_name'])<=0){
            return;
        }
       
        // if(strlen($this->user['password'])<8){
        //     $this->dispatch('swal:redirect',
        //         position         									: 'center',
        //         icon              									: 'warning',
        //         title             									: 'Password must be at least 8 character!',
        //         showConfirmButton 									: 'true',
        //         timer             									: '1000',
        //         link              									: '#'
        //     );
        //     return;
        // }
        if(intval($this->user['role_id'])<0){
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
        if(!($role = DB::table('roles')
            ->where('id','=',$this->user['role_id'])
            ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select role!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($role->name  == 'usc-admin'){
            if(intval($this->user['position_id'])<0){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
            if(!(DB::table('positions')
                ->where('id','=',$this->user['position_id'])
                ->first())){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
        }elseif($role->name  == 'csc-admin'){
            if(intval($this->user['position_id'])<0){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
            if(!(DB::table('positions')
                ->where('id','=',$this->user['position_id'])
                ->first())){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Please select position!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }

            if(intval($this->user['college_id'])<0){
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
            if(!(DB::table('colleges')
                ->where('id','=',$this->user['college_id'])
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
        }
        if(DB::table('users')
            ->where('id','=',$this->user['id'])
            ->update([
                'first_name' =>$this->user['first_name'],
                'middle_name' =>$this->user['middle_name'],
                'last_name' =>$this->user['last_name'],
                'school_year_id' =>$this->user['school_year_id'],
                'college_id' =>$this->user['college_id'],
                'role_id' =>$this->user['role_id'],
                'position_id' =>$this->user['position_id']
                ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->user = [
                'id' =>NULL,
                'first_name' =>NULL,
                'middle_name' =>NULL,
                'last_name' =>NULL,
                'username' =>NULL,
                'password' =>NULL,
                'college_id' =>NULL,
                'school_year_id' =>NULL,
                'role_id' =>NULL,
                'role_name' => 'usc-admin',
                'position_id' =>NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Unsuccessfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
    }
    public function saveDeleteUser($id,$modal_id){
        if(DB::table('users')
            ->where('id','=',$this->user['id'])
            ->update([
                'is_active' =>0
                ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            $this->user = [
                'id' =>NULL,
                'first_name' =>NULL,
                'middle_name' =>NULL,
                'last_name' =>NULL,
                'username' =>NULL,
                'password' =>NULL,
                'college_id' =>NULL,
                'school_year_id' =>NULL,
                'role_id' =>NULL,
                'role_name' => 'usc-admin',
                'position_id' =>NULL,
            ];
            $this->dispatch('closeModal',$modal_id);
            return;
        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Unsuccessfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
    }
        public function saveActivateUser($id,$modal_id){
            if(DB::table('users')
                ->where('id','=',$this->user['id'])
                ->update([
                    'is_active' =>1
                    ])){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Successfully updated!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                $this->user = [
                    'id' =>NULL,
                    'first_name' =>NULL,
                    'middle_name' =>NULL,
                    'last_name' =>NULL,
                    'username' =>NULL,
                    'password' =>NULL,
                    'college_id' =>NULL,
                    'school_year_id' =>NULL,
                    'role_id' =>NULL,
                    'role_name' => 'usc-admin',
                    'position_id' =>NULL,
                ];
                $this->dispatch('closeModal',$modal_id);
                return;
            }else{
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Unsuccessfully updated!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
        }
    }
}
