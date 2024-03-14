<?php

namespace App\Livewire\Admin\Settings\UserManagement;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserManagement extends Component
{
    public $title = "User Management";

    public $user = [
        'id' =>NULL,
        'first_name' =>NULL,
        'middle_name' =>NULL,
        'last_name' =>NULL,
        'username' =>NULL,
        'password' =>NULL,
        'college_id' =>NULL,
        'role_id' =>NULL,
        'position_id' =>NULL,
    ];
    public $colleges = [];
    public $roles = [];
    public $positions = [];
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
                "p.name as position_name"
            )
            ->join('roles as r','r.id','u.role_id')
            ->join('colleges as c','c.id','u.college_id')
            ->join('positions as p','p.id','u.position_id')
            ->paginate(10);
            // dd( $users_data );
        return view('livewire.admin.settings.user-management.user-management',[
            'users_data'=>$users_data])
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
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
            'role_id' =>NULL,
            'position_id' =>NULL,
        ];
        $this->positions = DB::table('positions')
            ->get()
            ->toArray();
        $this->colleges = DB::table('colleges')
            ->where('is_active','=',1)
            ->get()
            ->toArray();
        $this->roles = DB::table('roles')
        ->get()
        ->toArray();
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
        if(!(DB::table('roles')
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
        if(DB::table('users')
            ->insert([
                'first_name' =>$this->user['first_name'],
                'middle_name' =>$this->user['middle_name'],
                'last_name' =>$this->user['last_name'],
                'username' =>$this->user['username'],
                'password' =>bcrypt($this->user['password']),
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
                'role_id' =>NULL,
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
            "p.name as position_name"
        )
        ->join('roles as r','r.id','u.role_id')
        ->join('colleges as c','c.id','u.college_id')
        ->join('positions as p','p.id','u.position_id')
        ->where('u.id','=',$id)
        ->first();
        $this->user = [
            'id' => $user->id,
            'first_name' =>$user->first_name,
            'middle_name' =>$user->middle_name,
            'last_name' =>$user->last_name,
            'username' =>$user->username,
            'college_id' =>$user->college_id,
            'role_id' =>$user->role_id,
            'position_id' =>$user->position_id,
        ];
        $this->positions = DB::table('positions')
            ->get()
            ->toArray();
        $this->colleges = DB::table('colleges')
            ->where('is_active','=',1)
            ->get()
            ->toArray();
        $this->roles = DB::table('roles')
        ->get()
        ->toArray();
        $this->dispatch('openModal',$modal_id);
    }
}
