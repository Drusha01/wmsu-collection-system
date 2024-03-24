<?php

namespace App\Livewire\Admin\Colleges;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Colleges extends Component
{
    use WithPagination;
    public $title = "Colleges";

    public $college = [
        'id' => NULL,
        'code' => NULL,
        'name' => NULL,
        'is_active' => NULL
    ];
    public $departments = [];
    public $department = [
        'id' => NULL,
        'college_id'=> NULL,
        'code' => NULL,
        'name' => NULL,
        'is_active' => NULL
    ];
    public $filters = [
        'college_name'=>NULL,
        'prev_college_name'=>NULL,
      
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
        if($this->filters['college_name'] != $this->filters['prev_college_name']){
            $this->filters['prev_college_name'] =$this->filters['college_name'];
            $this->resetPage();
        }
        $colleges_data = DB::table('colleges as c')
            // ->where('is_active','=',1)
            ->where('c.name','like',$this->filters['college_name'] .'%')
            ->orderBy('c.is_active','desc')
            ->paginate(10);
        return view('livewire.admin.colleges.colleges',
            ['college_data'=>$colleges_data])
            ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addCollege(){
        $this->college = [
            'id' => NULL,
            'code' => NULL,
            'name' => NULL,
            'is_active' => NULL
        ];
    }
    public function saveAddCollege($modal_id){
        if(strlen($this->college['code'])<=0){
            return;
        }
        if(strlen($this->college['name'])<=0){
            return;
        }
       
        if(DB::table('colleges')
            ->where('name','=',$this->college['name'])
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'College name exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('colleges')
            ->where('code','=',$this->college['code'])
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'College code exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }

        if(DB::table('colleges')
            ->insert([
                'name'=>$this->college['name'],
                'code'=>$this->college['code'],
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully added!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has added a new college ('.$this->college['code'].') '.$this->college['name'],
                'link' =>route('admin-colleges'),
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }

    public function editCollege($id,$modal_id){
        if($college = DB::table('colleges')
            ->where('id','=',$id)
            ->first()){

        }
        $this->college = [
            'id' => $college->id,
            'code' => $college->code,
            'name' => $college->name,
            'is_active' => $college->is_active
        ];
        $this->dispatch('openModal',$modal_id);
    }

    public function saveEditCollege($id,$modal_id){
        if(strlen($this->college['code'])<=0){
            return;
        }
        if(strlen($this->college['name'])<=0){
            return;
        }
       
        if(DB::table('colleges')
            ->where('name','=',$this->college['name'])
            ->where('id','!=',$id)
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'College name exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('colleges')
            ->where('code','=',$this->college['code'])
            ->where('id','!=',$id)
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'College code exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }

        if(DB::table('colleges')
            ->where('id','=',$id)
            ->update([
                'name'=>$this->college['name'],
                'code'=>$this->college['code'],
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has updated a college ('.$this->college['code'].') '.$this->college['name'],
                'link' =>route('admin-colleges'),
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }
    public function saveDeleteCollege($id,$modal_id){
        if(DB::table('colleges')
            ->where('id','=',$id)
            ->update([
                'is_active'=>0,
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has deleted a college ('.$this->college['code'].') '.$this->college['name'],
                'link' =>route('admin-colleges'),
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }
    public function saveActivateCollege($id,$modal_id){
        if(DB::table('colleges')
            ->where('id','=',$id)
            ->update([
                'is_active'=>1,
            ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfully updated!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'created_by' =>$this->user_details->id,
                'log_details' =>'has activated a college ('.$this->college['code'].') '.$this->college['name'],
                'link' =>route('admin-colleges'),
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }

    public function ViewDepartment($id,$modal_id){
        if($college = DB::table('colleges')
        ->where('id','=',$id)
        ->first()){
            $this->college = [
                'id' => $college->id,
                'code' => $college->code,
                'name' => $college->name,
                'is_active' => $college->is_active
            ];
             
            $this->departments = DB::table('departments')
            ->where('college_id','=',$id)
            ->get()
            ->toArray();
            $this->dispatch('openModal',$modal_id);
        }
     
    }
    public function addDepartment($id,$modal_id){
        if($college = DB::table('colleges')
        ->where('id','=',$id)
        ->first()){
            $this->college = [
                'id' => $college->id,
                'code' => $college->code,
                'name' => $college->name,
                'is_active' => $college->is_active
            ];
            
            $this->department = [
                'id' => NULL,
                'college_id'=> $college->id,
                'code' => NULL,
                'name' => NULL,
                'is_active' => NULL
            ];
            $this->dispatch('openModal',$modal_id);
        }
    }
    public function saveAddDepartment($modal_id){
       
        if(strlen($this->department['code'])<=0){
            return;
        }
        if(strlen($this->department['name'])<=0){
            return;
        }
       
        if(DB::table('departments')
            ->where('name','=',$this->department['name'])
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Department name exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('departments')
            ->where('code','=',$this->department['code'])
            ->first()){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Department code exist!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(DB::table('colleges')
        ->where('id','=',$this->department['college_id'])
        ->first()){
           if(DB::table('departments')
            ->insert([
                    'college_id'=> $this->department['college_id'],
                    'code' => $this->department['code'],
                    'name' => $this->department['name'],
            ])){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Successfully added!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>1,
                    'created_by' =>$this->user_details->id,
                    'log_details' =>'has added a department ('.$this->department['code'].') '.$this->department['code'],
                    'link' =>route('admin-colleges'),
                ]);
                $this->dispatch('closeModal',$modal_id);
                return;
           }else{
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Unsuccessfully added!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
           }
            
        }else{
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Invalid College!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
    }
}
