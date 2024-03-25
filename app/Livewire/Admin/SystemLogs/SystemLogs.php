<?php

namespace App\Livewire\Admin\SystemLogs;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SystemLogs extends Component
{
    public $title = "System Logs";
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
    public function render()
    {
        $system_logs = DB::table('logs as l')
            ->select(
                'u.username',
                'u.first_name',
                'u.middle_name',
                'u.middle_name',
                'l.log_details',
                'l.date_created',
                'l.link'
            )
            ->join('users as u','u.id','l.created_by')
            ->where('log_type_id','=',1)
            ->orderBy('l.date_created','desc')
            ->paginate(10);
        return view('livewire.admin.system-logs.system-logs',[
            'system_logs'=>$system_logs
        ])
            ->layout('components.layouts.admin',[
                'title'=>$this->title]);
    }
}
