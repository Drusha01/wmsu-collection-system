<?php

namespace App\Livewire\Csc\Auditlogs;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Auditlogs extends Component
{

    use WithPagination;
    public $title = "AuditLogs";
    public $user_details;
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
    public function render()
    {
        $audit_logs = DB::table('logs as l')
            ->select(
                'u.username',
                'u.first_name',
                'u.middle_name',
                'u.last_name',
                'l.log_details',
                'l.date_created',
                'l.link'
            )
            ->join('users as u','u.id','l.created_by')
            ->where('l.log_type_id','=',2)
            ->where('l.school_year_id','=',$this->user_details->school_year_id)
            ->where('l.college_id','=',$this->user_details->college_id)
            ->orderBy('l.date_created','desc')
            ->paginate(10);
        return view('livewire.csc.auditlogs.auditlogs',[
            'audit_logs'=>$audit_logs
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
