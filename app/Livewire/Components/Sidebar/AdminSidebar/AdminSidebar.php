<?php

namespace App\Livewire\Components\Sidebar\AdminSidebar;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSidebar extends Component
{
    public $user_details;
    public function boot(Request $request ){
        $session = $request->session()->all();
        if(!isset($session['id'])){
            return redirect('/login');
        }
        $this->user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->get()
            ->first();
    }
    public function render()
    {
        return view('livewire.components.sidebar.admin-sidebar.admin-sidebar');
    }
}
