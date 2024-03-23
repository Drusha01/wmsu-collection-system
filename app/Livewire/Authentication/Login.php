<?php

namespace App\Livewire\Authentication;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login extends Component
{
    public $title = 'Login';

    public $username;
    public $password;

    public function render()
    {
        return view('livewire.authentication.login')
        ->layout('components.layouts.guest',[
            'title'=>$this->title]);
    }

    public function login(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id'])){ 
            $user_details = DB::table('users as u')
                ->select(
                    'u.id',
                    'u.password',
                    'u.username',
                    'r.name',
                    )
                ->where('u.username','=',$this->username)
                ->join('roles as r','u.role_id','r.id')
                ->first();
            if( $user_details && password_verify($this->password,$user_details->password)){
                $request->session()->regenerate();
                $request->session()->put('id', $user_details->id);
                if( $user_details->name == 'admin'){
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'success',
                        title             									: 'Welcome back admin!',
                        showConfirmButton 									: 'true',
                        timer             									: '1500',
                        link              									: 'admin/dashboard'
                    );
                }elseif($user_details->name == 'csc-admin'){
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'success',
                        title             									: 'Welcome back CSC admin!',
                        showConfirmButton 									: 'true',
                        timer             									: '1500',
                        link              									: 'csc/dashboard'
                    );
                }elseif($user_details->name == 'usc-admin'){
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'success',
                        title             									: 'Welcome back USC admin!',
                        showConfirmButton 									: 'true',
                        timer             									: '1500',
                        link              									: 'usc/dashboard'
                    );
                }
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>1,
                    'created_by' =>$user_details->id,
                    'log_details' =>'has logged in',
                    'link' => '#',
                ]);
            }else{
                $this->dispatch('swal:redirect',
                    position          									: 'center',
                    icon              									: 'warning',
                    title            									: 'Invalid credentials!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
            }
        }else{
            return redirect('/admin/dashboard');
        }
    }
}
