<?php

namespace App\Livewire\Admin\Settings\Overview;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Overview extends Component
{
    public $title = "Overview";
    
    public $semester = [
        'id' => NULL,
        'semester' => NULL,
        'date_start_date' => NULL,
        'date_start_month' => NULL,
        'date_end_date' => NULL,
        'date_end_month' => NULL,
    ];
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
        if(isset($session['id']) && $user_details = DB::table('users as u')
            ->select(
                'u.id',
                'r.name as role_name'
              )
            ->where('u.id','=',$session['id'])
            ->join('roles as r','r.id','u.role_id')
            ->get()
            ->first()){
            if ($user_details->role_name == 'usc-admin') {
                return redirect()->route('usc-dashboard');
            }else if ($user_details->role_name == 'admin') {

            }elseif($user_details->role_name == 'csc-admin'){
                return redirect()->route('csc-dashboard');
            }
        }else{
            return redirect('/login');
        }
    }
    public function render(){
        return view('livewire.admin.settings.overview.overview')
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function editSemester($id,$modal_id){
        $semester = DB::table('semesters')
            ->where('id','=',$id)
            ->get()
            ->first();
        $this->semester = [
            'id' => $semester->id,
            'semester' => $semester->semester,
            'date_start_date' => $semester->date_start_date,
            'date_start_month' => $semester->date_start_month,
            'date_end_date' => $semester->date_end_date,
            'date_end_month' => $semester->date_end_month,
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function saveSemester($id,$modal_id){
        dd($this->semester);
    }
}
