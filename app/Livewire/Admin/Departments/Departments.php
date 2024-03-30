<?php

namespace App\Livewire\Admin\Departments;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;
    public $title = "Departments";
    public $college_id = NULL;
    public $user_details;
    public $department = [
        'id' => NULL,
        'college_id'=> NULL,
        'code' => NULL,
        'name' => NULL,
        'is_active' => NULL
    ];
    public $filters = [
        'search'=> NULL,
        'search_by' => 'Department code',
        'prev_search'=> NULL,

    ];
    public $search_by = [
        0=>'Department code',
        1=>'Department name',
    ];
    public function mount($college_id){
        $this->college_id = $college_id;
    }
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

        $department_data = DB::table('departments as d')
            ->where('d.college_id','=',$this->college_id)
            ->paginate(10);
        return view('livewire.admin.departments.departments',[
            'department_data'=>$department_data
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addDepartment($modal_id){
        $this->department = [
            'id' => NULL,
            'college_id'=> $this->college_id,
            'code' => NULL,
            'name' => NULL,
            'is_active' => NULL
        ];
        $this->dispatch('openModal',$modal_id);
    }
    public function editDepartment($id,$modal_id){
        if($department = DB::table('departments')
            ->where('id','=',$id)
            ->first()){
            $this->department = [
                'id' => $department->id,
                'college_id'=> $this->college_id,
                'code' =>  $department->code,
                'name' =>  $department->name,
                'is_active' =>  $department->is_active
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
                    'link' => '/admin/departments/'.$this->department['college_id'],
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
    public function saveEditDepartment($id,$modal_id){

        if(strlen($this->department['code'])<=0){
            return;
        }
        if(strlen($this->department['name'])<=0){
            return;
        }

        if(DB::table('departments')
            ->where('name','=',$this->department['name'])
            ->where('id','<>',$id)

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
            ->where('id','<>',$id)
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
            ->where('college_id','=',$this->department['college_id'])
            ->where('id','=',$id)
            ->update([
                    'code' => $this->department['code'],
                    'name' => $this->department['name'],
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
                    'log_details' =>'has updated a department ('.$this->department['code'].') '.$this->department['code'],
                    'link' => '/admin/departments/'.$this->department['college_id'],
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
    public function saveDeleteDepartment($id,$modal_id){
        if(DB::table('departments')
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
                'log_details' =>'has deactivate a departments ('.$this->department['code'].') '.$this->department['name'],
                'link' => '/admin/departments/'.$this->department['college_id'],
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }
    public function saveActivateDepartment($id,$modal_id){
        if(DB::table('departments')
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
                'log_details' =>'has activated a departments ('.$this->department['code'].') '.$this->department['name'],
                'link' => '/admin/departments/'.$this->department['college_id'],
            ]);
            $this->dispatch('closeModal',$modal_id);
        }
    }

}
