<?php

namespace App\Livewire\Csc\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{

    public $title ="Profile";
    public $user_info = [
        'username' => NULL,
        'first_name' => NULL,
        'middle_name' => NULL,
        'last_name' => NULL,
        'term' => NULL,
        'role' => NULL,
        'college_name' => NULL,
        'position_name' => NULL,
    ];
    public function boot(Request $request ){

        $session = $request->session()->all();
        $user_id = $session['id'];
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'u.first_name',
                'u.middle_name',
                'u.last_name',
                'r.name as role_name',
                'p.name as position_name',
                'u.is_active',
                'u.college_id',
                'u.school_year_id',
                'c.name as college_name',
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as schoo_year')
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->leftjoin('positions as p','p.id','u.position_id')
            ->join('colleges as c','c.id','u.college_id')
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first()){
            $this->user_details = $user_details;
            
            $this->user_info = [
                'username' => NULL,
                'first_name' => NULL,
                'middle_name' => NULL,
                'last_name' => NULL,
                'term' => NULL,
                'role' => NULL,
                'college_name' => NULL,
                'position_name' => NULL,
            ];
        }else{
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.csc.profile.profile')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
