<?php

namespace App\Livewire\Csc\Enrolledstudents;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Enrolledstudents extends Component
{
    use WithPagination;

    public $title = "Enrolledstudents";
    public $semesters = [];
    public $year_levels = [];
    public $months = [
        0=>['month_name'=> 'January','month_number'=>1,'max_date'=>31],
        1=>['month_name'=> 'February','month_number'=>2,'max_date'=>28],
        2=>['month_name'=> 'March','month_number'=>3,'max_date'=>31],
        3=>['month_name'=> 'April','month_number'=>4,'max_date'=>30],
        4=>['month_name'=> 'May','month_number'=>5,'max_date'=>31],
        5=>['month_name'=> 'June','month_number'=>6,'max_date'=>30],
        6=>['month_name'=> 'July','month_number'=>7,'max_date'=>31],
        7=>['month_name'=> 'August','month_number'=>8,'max_date'=>31],
        8=>['month_name'=> 'September','month_number'=>9,'max_date'=>30],
        9=>['month_name'=> 'October','month_number'=>10,'max_date'=>31],
        10=>['month_name'=> 'Novermber','month_number'=>11,'max_date'=>30],
        11=>['month_name'=> 'December','month_number'=>12,'max_date'=>31],

    ];
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
        $colleges_data = DB::table('colleges')
            ->where('id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
        $department_data = DB::table('departments')
            ->where('college_id','=', $this->user_details->college_id)
            ->get()
            ->toArray();
      
        return view('livewire.csc.enrolledstudents.enrolledstudents',[
            'colleges_data'=>$colleges_data,
            'department_data'=>$department_data,
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addEnrolledStudents($modal_id){
        $this->semesters = DB::table('semesters')
        ->get()
        ->toArray();
        $this->year_levels = DB::table('year_levels')
            ->get()
            ->toArray();

        $this->dispatch('openModal',$modal_id);
    }
}
