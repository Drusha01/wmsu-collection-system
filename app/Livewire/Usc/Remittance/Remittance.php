<?php

namespace App\Livewire\Usc\Remittance;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Remittance extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $title = "Remittance";
    public $user_details;
    public $filters = [
        'college_id'=>NULL,
    ]; 
    public $remit = [
        'id' => NULL,
        'school_year_id'=> NULL,
        'semester_id' => NULL,
        'college_id' => NULL,
        'amount' => NULL,
        'remitted_by' => NULL,
        'remitted_date' => NULL,
        'appoved_by' => NULL,
        'approved_date' => NULL,
        'remit_photo' => NULL,
        'remit_photo_id'=>NULL,
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
        $semesters = DB::table('semesters')
            ->get()
            ->toArray();
        $remittance_data = DB::table('remits as r')
            ->select(
                'r.id',
                'u.username as approved_by_username',
                'u.first_name as approved_by_first_name',
                'u.middle_name as approved_by_middle_name',
                'u.last_name as approved_by_last_name',
                'rbyu.username as remitted_by_',
                'rbyu.first_name as remitted_by_first_name',
                'rbyu.middle_name as remitted_by_middle_name',
                'rbyu.last_name as remitted_by_last_name',
                'r.remitted_date',
                'r.approved_date' ,
                'r.remit_photo',
                'r.amount',
                'sy.year_start',
                'sy.year_end',
                's.semester',
                'r.appoved_by'
            )
            ->join('users as rbyu','rbyu.id','r.remitted_by')
            ->join('school_years as sy','sy.id','r.school_year_id')
            ->join('semesters as s','s.id','r.semester_id')
            ->leftjoin('users as u','u.id','r.appoved_by')
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->where('r.college_id','like',$this->filters['college_id'].'%')
            ->paginate(10);
        return view('livewire.usc.remittance.remittance',[
            'page_info'=>$page_info,
            'semesters'=>$semesters,
            'remittance_data'=>$remittance_data
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function editRemit($id,$modal_id){
        if($remit = DB::table('remits as r')
        ->select(
            'r.id',
            'u.username as approved_by_username',
            'u.first_name as approved_by_first_name',
            'u.middle_name as approved_by_middle_name',
            'u.last_name as approved_by_last_name',
            'rbyu.username as remitted_by_',
            'rbyu.first_name as remitted_by_first_name',
            'rbyu.middle_name as remitted_by_middle_name',
            'rbyu.last_name as remitted_by_last_name',
            'r.remitted_date',
            'r.approved_date' ,
            'r.remit_photo',
            'r.amount',
            'sy.year_start',
            'sy.year_end',
            's.semester',
            'r.school_year_id',
            'r.semester_id',
            'r.college_id',
            'r.remitted_by',
            'r.appoved_by'
        )
        ->join('users as rbyu','rbyu.id','r.remitted_by')
        ->join('school_years as sy','sy.id','r.school_year_id')
        ->join('semesters as s','s.id','r.semester_id')
        ->leftjoin('users as u','u.id','r.appoved_by')
        ->where('r.school_year_id','=',$this->user_details->school_year_id)
        ->where('r.id','=',$id)
        ->first()){
            $this->remit = [
                'id' => $remit->id,
                'school_year_id'=> $remit->school_year_id,
                'semester_id' => $remit->semester_id,
                'college_id' => $remit->college_id,
                'amount' => $remit->amount,
                'remitted_by' => $remit->remitted_by,
                'remitted_date' => $remit->remitted_date,
                'appoved_by' => $remit->appoved_by,
                'approved_date' => $remit->approved_date,
                'remit_photo' => $remit->remit_photo,
                'remit_photo_id'=>rand(),
            ];
            $this->dispatch('openModal',$modal_id);
        }
    }
    public function saveApproveRemit($id,$modal_id){
        if(!(DB::table('remits as r')
            ->join('users as u','u.id','r.appoved_by')
            ->where('r.id','=',$id)
            ->first())){
            if(DB::table('remits as r') 
            ->where('r.id','=',$id)
            ->update([
                'appoved_by' => $this->user_details->id,
                'approved_date' => DB::raw('NOW()'),
            ])){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Successfully approved!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$this->remit['school_year_id'],
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has approved a remit with the total amount of  ('.$this->remit['amount'].') to University Student Council',
                    'link' =>route('admin-remitrecords'),
                ]);
                $this->dispatch('closeModal',$modal_id);
            }
        }
    }
    public function saveCancelRemit($id,$modal_id){
        if((DB::table('remits as r')
            ->join('users as u','u.id','r.appoved_by')
            ->where('r.id','=',$id)
            ->first())){
            if(DB::table('remits as r') 
            ->where('r.id','=',$id)
            ->update([
                'appoved_by' => NULL,
                'approved_date' => NULL,
            ])){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Successfully approved!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$this->remit['school_year_id'],
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has cancelled a remit with the total amount of  ('.$this->remit['amount'].') to University Student Council',
                    'link' =>route('admin-remitrecords'),
                ]);
                $this->dispatch('closeModal',$modal_id);
            }
        }
    }
    
}
