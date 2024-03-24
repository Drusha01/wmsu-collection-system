<?php

namespace App\Livewire\Usc\Remitrecords;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Remitrecords extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $title = "RemitRecords";
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
        $page_info = DB::table('users as u')
        ->select(
            'c.name as college_name',
            DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
          )
        ->where('u.id','=',$this->user_details->id)
        ->leftjoin('colleges as c','c.id','u.college_id')
        ->join('school_years as sy','sy.id','u.school_year_id')
        ->get()
        ->first();
        return view('livewire.usc.remitrecords.remitrecords',[
            'page_info'=>$page_info
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
}
