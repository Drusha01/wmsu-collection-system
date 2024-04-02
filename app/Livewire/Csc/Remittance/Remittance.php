<?php

namespace App\Livewire\Csc\Remittance;

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
    public $filters = [
        'department_id'=>NULL,
        'semester_id' => NULL,
        'year_level_id' => NULL,
        'school_year_id'=> NULL,
        'college_id' => NULL,
        'fee_id' => NULL,
        'search'=> NULL,
        'search_by' => 'Username',
        'prevdepartment_id'=>NULL,
        'prevsemester_id' => NULL,
        'prevyear_level_id' => NULL,
        'prevcollege_id' => NULL,
        'prev_search'=> NULL,
        'prev_school_year_id'=> NULL,
        'prev_fee_id' => NULL,
        
    ];
    public $export_selected = 'PDF';
    public $downloadfilters = NULL;
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
    public function updateSearchDefault(){
        $this->filters['search'] = NULL;
        $this->filters['prev_search'] = NULL;
        $this->resetPage();
    }
    public function mount(){
        $this->downloadfilters = $this->filters;
    }
    public function render()
    {
        if($this->filters['search'] != $this->filters['prev_search']){
            $this->filters['prev_search'] =$this->filters['search'];
            $this->resetPage();
        }
        $remittance_data = [];
        if($this->filters['search_by'] == 'Username'){
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
                    'r.appoved_by'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where('r.college_id','=',$this->user_details->college_id)
                ->where('rbyu.username','like',$this->filters['search'] .'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
        }elseif($this->filters['search_by'] == 'Remitter name'){
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
                    'r.appoved_by'
                )
                ->join('users as rbyu','rbyu.id','r.remitted_by')
                ->join('school_years as sy','sy.id','r.school_year_id')
                ->join('semesters as s','s.id','r.semester_id')
                ->leftjoin('users as u','u.id','r.appoved_by')
                ->where('r.school_year_id','=',$this->user_details->school_year_id)
                ->where('r.college_id','=',$this->user_details->college_id)
                ->where(DB::raw("CONCAT(rbyu.first_name,' ',rbyu.middle_name,' ',rbyu.last_name)"),'like',$this->filters['search'] .'%')
                ->orderby('r.date_created','desc')
                ->paginate(10);
        }
        $page_info = DB::table('users as u')
        ->select(
            'c.name as college_name',
            DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
          )
        ->where('u.id','=',$this->user_details->id)
        ->join('colleges as c','c.id','u.college_id')
        ->join('school_years as sy','sy.id','u.school_year_id')
        ->get()
        ->first();
        $semesters = DB::table('semesters')
            ->get()
            ->toArray();
        return view('livewire.csc.remittance.remittance',[
            'page_info'=>$page_info,
            'semesters'=>$semesters,
            'remittance_data'=>$remittance_data
        ])
        ->layout('components.layouts.admin',[
            'title'=>$this->title]);
    }
    public function addRemit($modal_id){
        $this->remit = [
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
            'remit_photo_id'=>rand(),
        ];
        $this->dispatch('openModal',$modal_id);
    }

    public function saveAddRemit($modal_id){
        $this->remit['remit_photo_id'] = rand();
        if(floatval($this->remit['amount'])<=0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please input valid fee amount',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!(DB::table('semesters')
        ->where('id','=',$this->remit['semester_id'])
        ->first())){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Please select fee semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        $enrolled_students  = DB::table('enrolled_students as es')
            ->select(
                DB::raw('count(*) as total_students'),
                DB::raw('sum(is_muslim * 1 ) as total_muslim')
            )
            ->join('students as s','s.id','es.student_id')
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('es.school_year_id','=',$this->user_details->school_year_id)
            ->where('es.semester_id','=',$this->remit['semester_id'])
            ->first();
        $fee_type = DB::table('fee_types')
            ->where('name','=','University Fee')
            ->first();

        $msa_shares =  DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as msa_shares'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.college_id','=',0)
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->remit['semester_id'] )
            ->where('f.for_muslim','=',1 )
            ->first();
           

        $usc_shares =  DB::table('enrolled_students as es')
            ->select(
                DB::raw('sum(pi.amount) as usc_shares'),
            )
            ->join('students as s','es.student_id','s.id')
            ->join('fees as f','f.school_year_id',DB::raw('es.school_year_id and f.semester_id=es.semester_id'))
            ->join('fee_types as ft','f.fee_type_id','ft.id')
            ->leftjoin('payment_items as pi','pi.student_id',DB::raw('s.id and pi.fee_id=f.id '))
            ->where('f.college_id','=',0)
            ->where('es.college_id','=',$this->user_details->college_id)
            ->where('f.school_year_id','=',$this->user_details->school_year_id)
            ->where('f.semester_id','=',$this->remit['semester_id'] )
            ->first();
        $total_paid = DB::table('payment_items as pi')
            ->select(
                DB::raw('sum(amount) as total')
            )
            ->join('enrolled_students as es','es.student_id','pi.student_id')
            ->where('es.school_year_id','=',$this->user_details->school_year_id)
            ->where('es.semester_id','=',$this->remit['semester_id'])
            ->where('es.college_id','=',$this->user_details->college_id)
            ->first();
        $total_remitted = DB::table('remits as r')
                ->select(
                    DB::raw('sum(amount) as total')
                )
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->where('r.semester_id','=',$this->remit['semester_id'])
            ->where('r.college_id','=',$this->user_details->college_id)
            ->first();
       

            
        if(!($enrolled_students)){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'No students enrolled in this school year and semester',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if(!($usc_shares)){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'No fees added, please notify the University Student Council',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        $total = [
            'total_fees' => 0,
            'total_MSA_fees'=>0,
            'total_university_fees'=>0,
            'total_remitted' =>0,
            'total_paid' =>0,
        ];
        if($total_paid){
           $total['total_paid'] =  $total_paid->total;
        }
        if($total_remitted){
            $total['total_remitted'] =  $total_remitted->total;
        }if($usc_shares){
            $total['total_university_fees'] = $usc_shares->usc_shares;
        }
        if($msa_shares){
            $total['total_university_fees'] -= $msa_shares->msa_shares;
            $total['total_MSA_fees'] = $msa_shares->msa_shares;
        }
        if(((floatval($total['total_university_fees'])) *0.3) - floatval($total['total_remitted']) <0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'You have already exceeded the remitted an amount of '.floatval($total['total_remitted']).'!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if((($total['total_university_fees']) *0.3) - ($total['total_remitted']) - ($this->remit['amount']) + floatval(0.01) < 0){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'warning',
                title             									: 'Amount remitting exceeds total amount of '.((floatval($total['total_university_fees'])) *0.3) - floatval($total['total_remitted']),
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            return;
        }
        if($this->remit['remit_photo']){
            $remit['remit_photo'] = self::save_image($this->remit['remit_photo'],'remit_photo','remits','remit_photo');
            if($remit['remit_photo'] == 0){
                return;
            }
        }
        // validation ()
        if(DB::table('remits')
            ->insert([
                'id' => NULL,
                'school_year_id'=>  $this->user_details->school_year_id,
                'semester_id' => $this->remit['semester_id'],
                'college_id' => $this->user_details->college_id,
                'amount' =>  $this->remit['amount'],
                'remitted_by' => $this->user_details->id,
                'appoved_by' => NULL,
                'approved_date' => NULL,
                'remit_photo' =>  $remit['remit_photo'],
        ])){
            $this->dispatch('swal:redirect',
                position         									: 'center',
                icon              									: 'success',
                title             									: 'Successfuly remitted, please wait for USC approval!',
                showConfirmButton 									: 'true',
                timer             									: '1000',
                link              									: '#'
            );
            DB::table('logs')
                ->insert([
                    'id' =>NULL,
                    'log_type_id' =>2,
                    'school_year_id'=>$this->user_details->school_year_id,
                    'created_by' =>$this->user_details->id,
                    'college_id'=>$this->user_details->college_id,
                    'log_details' =>'has remitted an amount of  ('.$this->remit['amount'].') to University Student Council',
                    'link' =>route('admin-remitrecords'),
                ]);
            $this->dispatch('closeModal',$modal_id);
            return;
        }
        
    
    }

    public function save_image($image_file,$folder_name,$table_name,$column_name){
        if($image_file && file_exists(storage_path().'/app/livewire-tmp/'.$image_file->getfilename())){
            $file_extension =$image_file->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$image_file->getfilename();
            $size = Storage::size($tmp_name);
            $mime = Storage::mimeType($tmp_name);
            $max_image_size = 25 * 1024*1024; 
            $file_extensions = array('image/jpeg','image/png','image/jpg');
            
            if($size<= $max_image_size){
                $valid_extension = false;
                foreach ($file_extensions as $value) {
                    if($value == $mime){
                        $valid_extension = true;
                        break;
                    }
                }
                if($valid_extension){
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table($table_name)
                    ->where([$column_name=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/content/'.$folder_name.'/'.$new_file_name)){
                        return $new_file_name;
                    }
                }else{
                    $this->dispatch('swal:redirect',
                        position         									: 'center',
                        icon              									: 'warning',
                        title             									: 'Invalid image type!',
                        showConfirmButton 									: 'true',
                        timer             									: '1000',
                        link              									: '#'
                    );
                    return 0;
                }
            }else{
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'warning',
                    title             									: 'Image is too large!',
                    showConfirmButton 									: 'true',
                    timer             									: '1000',
                    link              									: '#'
                );
                return 0;
            } 
        }
        return 0;
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
        ->where('r.college_id','=',$this->user_details->college_id)
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
    public function saveDeleteRemit($id,$modal_id){
        if(!(DB::table('remits as r')
            ->join('users as u','u.id','r.appoved_by')
            ->where('r.id','=',$id)
            ->first())){
            if(DB::table('remits as r') 
            ->where('r.id','=',$id)
            ->delete()){
                $this->dispatch('swal:redirect',
                    position         									: 'center',
                    icon              									: 'success',
                    title             									: 'Successfully deleted!',
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
                    'log_details' =>'has voided a remit with the total amount of  ('.$this->remit['amount'].') to University Student Council',
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
                'r.appoved_by'
            )
            ->join('users as rbyu','rbyu.id','r.remitted_by')
            ->join('school_years as sy','sy.id','r.school_year_id')
            ->join('semesters as s','s.id','r.semester_id')
            ->leftjoin('users as u','u.id','r.appoved_by')
            ->where('r.school_year_id','=',$this->user_details->school_year_id)
            ->where('r.college_id','=',$this->user_details->college_id)
            ->orderby('r.date_created','desc')
            ->get()
            ->toArray();

       
        $page_info = DB::table('users as u')
            ->select(
                'c.name as college_name',
                DB::raw('CONCAT(sy.year_start," - ",sy.year_end) as school_year')
            )
            ->where('u.id','=',$this->user_details->id)
            ->join('colleges as c','c.id','u.college_id')
            ->join('school_years as sy','sy.id','u.school_year_id')
            ->get()
            ->first();
        $current_semester = DB::table('semesters')
            ->where('id','=',$this->downloadfilters['semester_id'])
            ->first();
        $semester = NULL;
        if($current_semester){
            $semester = $current_semester->semester;
        }
        
        
        $file_name = 'Remittance Records';
        $type = $this->export_selected;
        $header = [
            ['Title'=>  'Remittance Records'],
            ['Academic Year'=>  'Academic Year '.$page_info->school_year ],
            ['content'=> $page_info->college_name],
            ['content'=> $semester],
            ['content'=>NULL],
            ['content'=>NULL]
        ];
        $content = [];
        array_push($content,[
            '#',
            'Remitted By Username',
            'Remitted By',
            'School Year',
            'Semester',
            'Date',
            'Approval Status',
            'Approved By',
            'Amount',
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
                'log_details' =>'has downloaded a Remittance '.$type ,
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
                'log_details' =>'has downloaded a Remittance '.$type ,
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
                'log_details' =>'has downloaded a Remittance '.$type ,
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
                'log_details' =>'has downloaded a Remittance '.$type ,
            ]);
            return Excel::download($export, $file_name.'.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }

}
