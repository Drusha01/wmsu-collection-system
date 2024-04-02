<?php

namespace App\Livewire\Usc\Remittance;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Controllers\export\export as ExporterController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class Remittance extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $title = "Remittance";
    public $user_details;
    public $college_data = [];
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'school_year_id'=> NULL,
        'college_id' => NULL,
        'student_code_search'=> NULL,
        'username'=> NULL,
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prevstudent_code_search'=> NULL,
        'prev_school_year_id'=> NULL,
        'prev_username'=> NULL,
        'search'=> NULL,
        'search_by' => 'Username',
        'prev_search' => NULL,
        
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
    public $export_selected = 'PDF';
    public $downloadfilters =NULL;
    public $export_types = [
        0=>['name'=>'EXCEL'],
        1=>['name'=>'CSV'],
        2=>['name'=>'PDF'],

    ];
    public $search_by = [
        0=>'Username',
        1=>'Remitter name',
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
    public function mount(){
        $this->college_data = DB::table('colleges')
            ->get()
            ->toArray();
        $this->downloadfilters = $this->filters;
    }
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
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
        $remittance_data = [];
        if($this->filters['search_by'] == 'Username'){
            if($this->filters['college_id']){
                $remittance_data = DB::table('remits as r')
                ->select(
                    'r.id',
                    'u.username as approved_by_username',
                    'u.first_name as approved_by_first_name',
                    'u.middle_name as approved_by_middle_name',
                    'u.last_name as approved_by_last_name',
                    'rbyu.username as remitted_by_username',
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
                    'r.appoved_by',
                    'c.name as college_name'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->leftjoin('colleges as c','c.id','rbyu.college_id')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where('r.college_id','=',$this->filters['college_id'])
                ->where('rbyu.username','like',$this->filters['search'].'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
            }else{
                $remittance_data = DB::table('remits as r')
                ->select(
                    'r.id',
                    'u.username as approved_by_username',
                    'u.first_name as approved_by_first_name',
                    'u.middle_name as approved_by_middle_name',
                    'u.last_name as approved_by_last_name',
                    'rbyu.username as remitted_by_username',
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
                    'r.appoved_by',
                    'c.name as college_name'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->leftjoin('colleges as c','c.id','rbyu.college_id')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where('rbyu.username','like',$this->filters['search'].'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
            }
        }elseif($this->filters['search_by'] == 'Remitter name'){
            if($this->filters['college_id']){
                $remittance_data = DB::table('remits as r')
                ->select(
                    'r.id',
                    'u.username as approved_by_username',
                    'u.first_name as approved_by_first_name',
                    'u.middle_name as approved_by_middle_name',
                    'u.last_name as approved_by_last_name',
                    'rbyu.username as remitted_by_username',
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
                    'r.appoved_by',
                    'c.name as college_name'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->leftjoin('colleges as c','c.id','rbyu.college_id')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where('r.college_id','=',$this->filters['college_id'])
                ->where(DB::raw("CONCAT(rbyu.first_name,' ',rbyu.middle_name,' ',rbyu.last_name)"),'like',$this->filters['search'] .'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
            }else{
                $remittance_data = DB::table('remits as r')
                ->select(
                    'r.id',
                    'u.username as approved_by_username',
                    'u.first_name as approved_by_first_name',
                    'u.middle_name as approved_by_middle_name',
                    'u.last_name as approved_by_last_name',
                    'rbyu.username as remitted_by_username',
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
                    'r.appoved_by',
                    'c.name as college_name'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->leftjoin('colleges as c','c.id','rbyu.college_id')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where(DB::raw("CONCAT(rbyu.first_name,' ',rbyu.middle_name,' ',rbyu.last_name)"),'like',$this->filters['search'] .'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
            }
        }
       
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
            'rbyu.username as remitted_by_username',
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
    public function downloadExportDefault($modal_id){
        $this->downloadfilters = $this->filters;
        $this->dispatch('openModal',$modal_id);
    }
    public function downloadExport($modal_id){
        if($this->downloadfilters['college_id']){
            $remittance_data = DB::table('remits as r')
            ->select(
                'r.id',
                'u.username as approved_by_username',
                'u.first_name as approved_by_first_name',
                'u.middle_name as approved_by_middle_name',
                'u.last_name as approved_by_last_name',
                'rbyu.username as remitted_by_username',
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
                'r.appoved_by',
                'c.name as college_name'
            )
            ->join('users as rbyu','rbyu.id','r.remitted_by')
            ->leftjoin('colleges as c','c.id','rbyu.college_id')
            ->join('school_years as sy','sy.id','r.school_year_id')
            ->join('semesters as s','s.id','r.semester_id')
            ->leftjoin('users as u','u.id','r.appoved_by')
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->where('r.college_id','=',$this->downloadfilters['college_id'])
            ->orderby('r.date_created','desc')
            ->get()
            ->toArray();
        }else{
            $remittance_data = DB::table('remits as r')
            ->select(
                'r.id',
                'u.username as approved_by_username',
                'u.first_name as approved_by_first_name',
                'u.middle_name as approved_by_middle_name',
                'u.last_name as approved_by_last_name',
                'rbyu.username as remitted_by_username',
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
                'r.appoved_by',
                'c.name as college_name'
            )
            ->join('users as rbyu','rbyu.id','r.remitted_by')
            ->leftjoin('colleges as c','c.id','rbyu.college_id')
            ->join('school_years as sy','sy.id','r.school_year_id')
            ->join('semesters as s','s.id','r.semester_id')
            ->leftjoin('users as u','u.id','r.appoved_by')
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->orderby('r.date_created','desc')
            ->get()
            ->toArray();
        }

        $college_name_filter = DB::table('colleges')
            ->where('id','=',$this->downloadfilters['college_id'])
            ->first();
        $college_name = NULL;
        if($college_name_filter){
            $college_name = $college_name_filter->name;
        }

        $page_info = DB::table('users as u')
            ->select(
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
            )
            ->where('u.id','=',$this->user_details->id)
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first();

        
        
        $file_name = 'Remittance Records';
        $type = $this->export_selected;
        $header = [
            ['Title'=>  'Remittance Records'],
            ['Academic Year'=>  'Academic Year '.$page_info->school_year ],
            ['content'=> $college_name],
            ['content'=>NULL],
            ['content'=>NULL]
        ];
        $content = [];
        array_push($content,[
            '#',
            'Remitted By Username',
            'Remitted By',
            'College',
            'School Year',
            'Semester',
            'Date',
            'Approval Status',
            'Approved By',
            'Amount',
            'Proof',
        ]);
        foreach ($remittance_data as $key =>$value){
            $content_item = [];          
            array_push($content_item,$key+1);
            array_push($content_item,$value->remitted_by_username);
            array_push($content_item,$value->remitted_by_first_name. ' ' .$value->remitted_by_middle_name.' ' .$value->remitted_by_last_name);
            array_push($content_item,$value->year_start.' - '.$value->year_end);
            array_push($content_item,$value->semester);
            array_push($content_item,date_format(date_create($value->remitted_date),"M d, Y"));
            
            array_push($content_item,($value->appoved_by) > 0  ?"Approved":"Pending");
            array_push($content_item,($value->appoved_by) > 0  ? $value->approved_by_first_name. ' ' .$value->approved_by_middle_name.' ' .$value->approved_by_last_name:"Pending");
            array_push($content_item,number_format($value->amount, 2, '.', ','));
            array_push($content,$content_item);

        }

       
        array_push($content,[]);
        array_push($content,[]);
       
        if($type == 'EXCEL'){
            $export = new ExporterController([
                $header,
                $content
            ]);
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=> $this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Remittance Records'.$type,
                'link' =>'#',
            ]);
            return Excel::download($export, $file_name.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }elseif($type == 'CSV'){
            $export = new ExporterController([
                $header,
                $content
            ]);
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Remittance Records'.$type,
                'link' =>'#',
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }elseif($type == 'PDF'){
            $pdf = Pdf::loadView('livewire.csc.export.exportpdf',  array( 
                'header'=>$header,
                'content'=> $content)
            );
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Remittance Records'.$type,
                'link' =>'#',
            ]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->setPaper('a4', 'landscape')->stream();
            },  $file_name.'.pdf');
        }else{
            $export = new ExporterController([
                $header,
                $content
            ]);
            DB::table('logs')
            ->insert([
                'id' =>NULL,
                'log_type_id' =>1,
                'school_year_id'=>$this->user_details->school_year_id,
                'created_by' =>$this->user_details->id,
                'college_id'=>$this->user_details->college_id,
                'log_details' =>'has downloaded a Remittance Records'.$type,
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
    
}
