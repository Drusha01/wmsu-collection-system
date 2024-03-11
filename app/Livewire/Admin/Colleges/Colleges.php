<?php

namespace App\Livewire\Admin\Colleges;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Colleges extends Component
{
    public $title = "Colleges";
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
    public function render()
    {
        return view('livewire.admin.colleges.colleges')
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
