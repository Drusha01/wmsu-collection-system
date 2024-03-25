<?php

namespace App\Livewire\Admin\Settings\Overview;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Overview extends Component
{
    use WithPagination;
    public $title = "Overview";
    
    public $semester = [
        'id' => NULL,
        'semester' => NULL,
        'date_start_date' => NULL,
        'date_start_month' => NULL,
        'date_end_date' => NULL,
        'date_end_month' => NULL,
    ];
    public $school_year = [
        'id' => NULL,
        'year_start'=> NULL,
        'year_end' => NULL,
        'date_start' => NULL,
        'date_end' => NULL,
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
    public function render(){
        $school_years = DB::table('school_years')
            ->paginate(10);
        return view('livewire.admin.settings.overview.overview',[
            'school_years'=>$school_years
        ])
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
        if($this->semester['date_start_month'] < 0 || $this->semester['date_start_month'] > 12){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid start month',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($this->semester['date_start_date'] > $this->months[$this->semester['date_start_month']-1]['max_date']  || $this->semester['date_start_date'] < 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid start date',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }

        if($this->semester['date_end_month'] < 0 || $this->semester['date_end_month'] > 12){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid end month',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($this->semester['date_end_date'] > $this->months[$this->semester['date_end_month']-1]['max_date']  || $this->semester['date_end_date'] < 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid end date',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($this->semester['date_start_month'] >= $this->semester['date_end_month']){
            if($this->semester['date_start_month'] == $this->semester['date_end_month'] && $this->semester['date_start_date'] >= $this->semester['date_end_date']){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Start date must be previous of end date',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return;
            }
        }
        if(DB::table('semesters')
            ->where('id','=',$this->semester['id'])
            ->update([
                'date_start_date' => $this->semester['date_start_date'],
                'date_start_month' => $this->semester['date_start_month'],
                'date_end_date' => $this->semester['date_end_date'],
                'date_end_month' => $this->semester['date_end_month'],
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has updated ('.$this->semester['semester'].')',
                'link' =>route('admin-overview'),
            ]);
            $this->dispatch('closeModal',$modal_id);
            return;
        }
    }
    public function addSchoolYear(){
        $latest_school_year = DB::table('school_years')
            ->orderBy('id','desc')
            ->first();
        $first_semester = DB::table('semesters')
            ->where('semester','=','1st semester')
            ->first();
        $second_semester = DB::table('semesters')
            ->where('semester','=','2nd semester')
            ->first();
        $this->school_year = [
            'id' => NULL,
            'year_start'=> $latest_school_year->year_start+1,
            'year_end' => $latest_school_year->year_end+1,
            'date_start' => ($latest_school_year->year_start+1).'-'.$first_semester->date_start_month.'-'.$first_semester->date_start_date,
            'date_end' => ($latest_school_year->year_end+1).'-'.$second_semester->date_end_month.'-'.$second_semester->date_end_date,
        ];
        if(DB::table('school_years')
            ->insert([
                'year_start'=>$this->school_year['year_start'],
                'year_end' => $this->school_year['year_end'],
                'date_start' => $this->school_year['date_start'],
                'date_end' => $this->school_year['date_end'],
        ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
        }
    }
}
