<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;

class displays extends Controller
{
    public function displays(Request $request)
    {
        $user_id=$request->session()->get('id');
        $workgroup_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        
        $workstation_ids=\App\Models\Workstation::whereIn('workgroup_id', $workgroup_ids)->pluck('id');
        $total_displays=\App\Models\Display::whereIn('workstation_id', $workstation_ids)->count();
        
        $facilities_ids=\App\Models\Workgroup::whereIn('id', $workgroup_ids)->pluck('facility_id');
        $facilities=\App\Models\Facility::whereIn('id', $facilities_ids)->get();
        
        return view('displays.displays', ['title'=>'Displays', 'total_displays'=>$total_displays, 'facilities'=>$facilities]);
    }

    public function list_displays(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        $role=$request->session()->get('role');
        
        $type=$request->input('type');
        if($type=='failed') $type=2;
        elseif($type=='ok') $type=1;

        $workstation_id = request('workstation_id')?request('workstation_id'):'';
        $items = \App\Models\Display::with('workstation.workgroup.facility');

        if($type)
        {
            $items->where('status', $type);
        }

        $items->when($workstation_id, function($q) use ($workstation_id) {
            return $q->where('workstation_id','=',$workstation_id);
        });

        if($role!='super') {
        $facility_id = $user->facility_id;
        $items->when($facility_id, function($q) use ($facility_id) {
            return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                     ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                     ->where('workgroups.facility_id','=',$facility_id);
        })->select('displays.*');
        }
        else{
            $facility_id = 1;
            $items->when($facility_id, function($q) use ($facility_id) {
            return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                     ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id');
            })->select('displays.*');
        }

        return Datatables::of($items)
                ->rawColumns(['link', 'history_link', 'workstation.link', 'workstation.workgroup.link', 'workstation.workgroup.facility.link', 'statusText', 'status'])
                ->filterColumn('status', function($query, $keyword) {
                    $sql = "status=?";
                    if (strtoupper($keyword) == 'OK') {
                        $keyword = 1;
                    } elseif (strtoupper($keyword) == 'FAILED') {
                        $keyword = 2;
                    }
                    $query->whereRaw($sql, [$keyword]);
                })
                ->filter(function ($query) use ($request) {
                    // Check if there's a search term
                    if ($search = $request->input('search.value')) {
                        // Apply search to multiple columns
                        $query->where(function ($query) use ($search) {
                            $query->where('displays.manufacturer', 'like', "%{$search}%")
                            ->orWhere('displays.model', 'like', "%{$search}%")
                            ->orWhere('workstations.name', 'like', "%{$search}%")
                            ->orWhere('workgroups.name', 'like', "%{$search}%")
                            ->orWhere('displays.serial', 'like', "%{$search}%");
                        });
                    }
                })
                ->make(true);

        // $workstation_id = request('workstation_id')?request('workstation_id'):'';
        // if (auth()->user()->hasRole('admin')) {
        //     if ($workstation_id!='') {
        //         $items = auth()->user()->facility->displays()->With('Workstation.Workgroup.Facility')->where('workstation_id', $workstation_id)->latest()->get();
        //     } else {
        //         $items = auth()->user()->facility->displays()->With('Workstation.Workgroup.Facility')->latest()->get();     
        //     }
        // } else {
        //     if ($workstation_id!='') {
        //         $items = Display::With('Workstation.Workgroup.Facility')->where('workstation_id', $workstation_id)->latest()->get();   
        //     } else {
        //         $items = Display::With('Workstation.Workgroup.Facility')->latest()->get();  
        //     }
        // }

        // return Datatables::of($items)
        //         ->rawColumns(['link', 'workstation.link', 'workstation.workgroup.link', 'workstation.workgroup.facility.link', 'statusText'])
        //         ->make(true);
    }

    public function list_displays_tasks(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        $userRole=$request->session()->get('role');

        $ids = request()->input('id') ? explode(',', request()->input('id')) : [];
        $task = \App\Models\Task::with(['ScheduleType', 'taskType', 'display.workstation.workgroup.facility'])
            ->where(['type' => 'cal', 'deleted' => 0])
            ->has('display');
        $task->when(count($ids) > 0, function ($q) use ($ids) {
            return $q->whereIn('display_id', $ids);
        });

if($userRole!='super') {
        $facility_id = $user->facility_id;

        $task->when($facility_id, function ($q) use ($facility_id) {
            return $q->join('displays', 'displays.id', '=', 'tasks.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                ->join('task_types', 'tasks.type', '=', 'task_types.key')
                ->join('schedule_types', 'tasks.schtype', '=', 'schedule_types.client_id')
                ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('tasks.*,tasks.startdate as startdate1, nextrun as due_date_sort, nextrun as duedate'));
}

        if($userRole=='super')
        {
            $facility_id2=1;
        $task->when($facility_id2, function ($q) use ($facility_id2) {
            return $q->join('displays', 'displays.id', '=', 'tasks.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                ->join('task_types', 'tasks.type', '=', 'task_types.key')
                ->join('schedule_types', 'tasks.schtype', '=', 'schedule_types.client_id')
                ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id');
        })->select(DB::raw('tasks.*,tasks.startdate as startdate1, nextrun as due_date_sort, nextrun as duedate'));
        }

        return Datatables::of($task)
        ->addColumn('due_raw', function ($task) {
        // Use nextrun if available, otherwise convert startdate + starttime
        return $task->nextrun ?? strtotime($task->startdate . ' ' . $task->starttime);
    })
    ->addColumn('due_display', function ($task) {
        $timestamp = $task->nextrun ?? strtotime($task->startdate . ' ' . $task->starttime);
        return date('d/m/Y H:i', $timestamp);
    })
    ->addColumn('duedate_display', function ($task) {
    return $task->startdatetimedisplay; // your accessor
})
        ->filter(function ($query) use ($request) {
            // Check if there's a search term
            /*
            if ($search = $request->input('search.value')) {
                // Apply search to multiple columns
                $query->where(function ($query) use ($search) {
                    $query->where('task_types.title', 'like', "%{$search}%")
                            ->orWhere('displays.manufacturer', 'like', "%{$search}%")
                            ->orWhere('displays.model', 'like', "%{$search}%")
                            ->orWhere('displays.serial', 'like', "%{$search}%")
                          ->orWhere('schedule_types.title', 'like', "%{$search}%")
                          ->orWhere('facilities.name', 'like', "%{$search}%")  // Search in facility name
                          ->orWhere('workstations.name', 'like', "%{$search}%")
                          ->orWhere('workgroups.name', 'like', "%{$search}%");
                });
            }*/
            if ($search = $request->input('search.value')) {
        $terms = preg_split('/\s+/', trim($search)); // Split by whitespace
        $query->where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('task_types.title', 'like', "%{$term}%")
                        ->orWhere('displays.manufacturer', 'like', "%{$term}%")
                        ->orWhere('displays.model', 'like', "%{$term}%")
                        ->orWhere('displays.serial', 'like', "%{$term}%")
                        ->orWhere('schedule_types.title', 'like', "%{$term}%")
                        ->orWhere('facilities.name', 'like', "%{$term}%")
                        ->orWhere('workstations.name', 'like', "%{$term}%")
                        ->orWhere('workgroups.name', 'like', "%{$term}%");
                });
            }
        });
    }
        })
            ->rawColumns(['ScheduleType.title', 'display.link', 'display.workstation.link', 'display.workstation.workgroup.link', 'display.workstation.workgroup.facility.link'])
            ->make(true);
    }
    
    public function fetch_workgroups(Request $request)
    {
        $data=array();
        $data['success']=0;
        
        $data['content']="<option value=''>Select facility first</option>";
        
        $facility_id=$request->input('id');
        if($facility_id=='') $facility_id=0;
            
        $row=\App\Models\Workgroup::where('facility_id', $facility_id)->get();
        if(count($row)!=0) $data['content']="<option value=''>Please select</option>";
       
        foreach($row as $r)
        {
            $data['content'].="<option value='".$r->id."'>".$r->name."</option>";
        }
       
        $data['success']=1;
        return response()->json($data);
    }
    
    public function fetch_workstations(Request $request)
    {
        $data=array();
        $data['success']=0;
        
        $data['content']="<option value=''>Please select</option>";
        
        $workgroup_id=$request->input('id');
        if($workgroup_id=='') $workgroup_id=0;
        
        $row=\App\Models\Workstation::where('workgroup_id', $workgroup_id)->get();
        foreach($row as $r){
            $data['content'].="<option value='".$r->id."'>".$r->name."</option>";
        }
        
        $data['success']=1;
         return response()->json($data);
    }
    
    public function fetch_displays(Request $request)
    {
        $data=array();
        $data['success']=0;
        
        $data['content']="<option value=''>Please select</option>";
        
        $workstation_id=$request->input('id');
        if($workstation_id=='') $workstation_id=0;
            
        $row=\App\Models\Display::where('workstation_id', $workstation_id)->get();
       
        foreach($row as $r)
        {
            $data['content'].="<option value='".$r->id."'>".$r->manufacturer." ".$r->model." (".$r->serial.")</option>";
        }
       
        $data['success']=1;
        return response()->json($data);
        
    }
    
    public function delete_display(Request $request)
    {
        $data=array();
        $data['msg']='';
        $data['success']=0;
        $user_id=$request->session()->get('id');
        
        $delete_id=$request->input('id');
        $check=\App\Models\Display::where('id', $delete_id)->delete();

        $data['success']=0;
        $data['msg']='Display deleted successfully!';
        return response()->json($data);
    }
    
    public function display_calibration(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        $userRole=$request->session()->get('role');

        //$workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        //$facility_ids=\App\Models\Workgroup::whereIn('id', $workgroups_ids)->pluck('facility_id');
        //$facilities=\App\Models\Facility::whereIn('id', $facility_ids)->pluck('name','id');

        $cacheKey = '';
        if ($userRole!='super') { // load current facility only
            $facilities = array($user->facility);
            //var_dump($facilities); exit();

        } else { // load all facilities
            $facilities = \App\Models\Facility::all();
        }
        
        
        if($request->input('calibrate')!='')
        {
            $facility=$request->input('facility');
            $workgroup=$request->input('workgroup');
            $workstation=$request->input('workstation');
            $displays=$request->input('displays');
            
            //set_timezone();
            $date=date('Y-m-d');
            $time=date('H:i');
            $unixtime=now()->timestamp;

            if($request->input('displays')==null)
            {
                if($workgroup==null AND $workstation==null)
                {
                    /*$workgroups=\App\Models\Workgroup::where('facility_id', $facility)->select('id')->get();
                    foreach($workgroups as $r2)
                    {
                        $workstations=\App\Models\Workstation::where('workgroup_id', $r2->id)->select('id')->get();
                        foreach($workgroups as $r3)
                        {
                            $displays=\App\Models\Display::where('workstation_id', $r3->id)->select('id')->get();
                        }
                    }*/
                    $facility_id=$facility;
                    $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->pluck('displays.id');
                    $displays=$items;
                }
                elseif($workstation==null)
                {
                    $facility_id=$facility;
                    $workgroup_id=$workgroup;
                    $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->where('workgroups.id', '=', $workgroup_id)  // Filter by workgroup_id
                    ->pluck('displays.id');
                    $displays=$items;
                }
                else
                {
                    $facility_id=$facility;
                    $workgroup_id=$workgroup;
                    $workstation_id=$workstation;
                    $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->where('workgroups.id', '=', $workgroup_id)   // Filter by workgroup_id
                    ->where('workstations.id', '=', $workstation_id)  // Filter by workstation_id
                    ->pluck('displays.id');
                    $displays=$items;
                }
            }
            
            foreach($displays as $display) {
                $d = \App\Models\Display::find($display);
                if ($d->preference('exclude')) continue;

                if ($userRole!='super') {
                    $timezone=$user->facility->timezone;
                }
                else $timezone=$d->workstation->workgroup->facility->timezone;

                \App\Models\Task::create([
                    'display_id' => $display ,
                    'type' => 'cal',
                    'testpattern' => 'SMPTE',
                    'schtype' => 1,
                    'startdate' => Carbon::now()->timezone($timezone)->format('Y.m.d'),
                    'starttime' => Carbon::now()->timezone($timezone)->format('H:i'),
                    'status' => 0,
                    'nextrun' => $unixtime,
                    'user_id' => $user_id,
                    'sync' => 0,
                    'deleted' => 0,
                    'created_at'=>NOW()
                ]);
            }
            
            $request->session()->flash('success', "Calibration task created successfully!");
            return redirect('display-calibration');
        }

        if($request->input('tasktype')!='')
        {
            $tasktype=$request->input('tasktype');
            $scheduletype=$request->input('scheduletype');
            $disabletask=$request->input('disabletask');
            $starttime=$request->input('starttime');
            $dailytask=$request->input('dailytask');
            $dayinmonth=$request->input('dayinmonth');
            $week=$request->input('week');
            $rdayinmonth=$request->input('rdayinmonth');
            $dayofmonth=$request->input('dayofmonth');
            $week_of_month=$request->input('week_of_month');
            $monthly=$request->input('monthly');
            $weekdays=$request->input('weekdays');
            $startdate=$request->input('startdate');
            
            //set_timezone();
            $date=date('Y-m-d');
            $time=date('H:i');
            $unixtime=now()->timestamp;
            
            foreach($displays as $display) {
                \App\Models\Task::create([
                    'display_id' => $display ,
                    'type' => 'cal',
                    'testpattern' => 'SMPTE',
                    'schtype' => 1,
                    'startdate' => $date,
                    'starttime' => $time,
                    'status' => 0,
                    'nextrun' => $unixtime,
                    'user_id' => $user_id,
                    'sync' => 0,
                    'deleted' => 0,
                    'created_at'=>NOW()
                ]);
            }
            
            $request->session()->flash('success', "Calibration task created successfully!");
            return redirect('display-calibration');
        }
        
        return view('displays.display_calibration', ['title'=>'Display Calibration', 'facilities'=>$facilities]);
    }
    
    public function fetch_displays_checklist(Request $request)
    {
        $data=array();
        $data['success']=0;
        
        $data['content']="<div class='form-check mb-0 py-1 px-4'>
        <input class='form-check-input flex-shrink-0' type='checkbox' id='formCheck-7' name='displays[]'>
        <label class='form-check-label flex-grow-1' for='formCheck-7'>Select All</label>
        </div>";
        $data['content']='';
        
        $workstation_id=$request->input('id');
        if($workstation_id=='') $workstation_id=0;
            
        $row=\App\Models\Display::where('workstation_id', $workstation_id)->get();
       
        foreach($row as $r)
        {
            $data['content'].="<div class='form-check mb-0 py-1 px-4'>
        <input class='form-check-input flex-shrink-0 displays-check' type='checkbox' id='display-".$r->id."' value='".$r->id."' name='displays[]'>
        <label class='form-check-label flex-grow-1' for='display-".$r->id."'>".$r->manufacturer." ".$r->model." (".$r->serial.")</label>
        </div>";
        }

        //if(count($row)==0) $data['content']='';
       
        $data['success']=1;
        return response()->json($data);
    }
    
    public function display_settings(Request $request, $display_id)
    {
        $user_id=$request->session()->get('id');
        $userRole=$request->session()->get('role');
        
        $workstation_app=$request->input('workstation_app');
        $leaf = 'di';
        if (strtoupper($workstation_app)=='ALL') $workstation_app = '';
        
        //$workgroup_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        //$facilities_ids=\App\Models\Workgroup::whereIn('id', $workgroup_ids)->pluck('facility_id');
        //$facilities=\App\Models\Facility::whereIn('id', $facilities_ids)->select('id', 'name')->get();
        /*$settings=\App\Models\SettingName::pluck('setting_value', 'setting_name')->toArray();
        $display_tech=json_decode($settings['DisplayTechnology'], 1);
        foreach($display_tech as $value)
        {
            echo $value;
            echo '<br>';
        }
        exit();*/
        $workstation_id=\App\Models\Display::where('id', $display_id)->pluck('workstation_id')->toArray();
        $workstation_id=$workstation_id[0];
        $workgroup_id=\App\Models\Workstation::where('id', $workstation_id)->pluck('workgroup_id')->toArray();
        $workgroup_id=$workgroup_id[0];
        $facility_id=\App\Models\Workgroup::where('id', $workgroup_id)->pluck('facility_id')->toArray();
        $facility_id=$facility_id[0];
        
        //$workgroups=\App\Models\Workgroup::where('facility_id', $facility_id)->get();
        //$workstations=\App\Models\Workstation::where('workgroup_id', $workgroup_id)->get();
        
        /*if ($userRole!='super') {
            // load user facility only
            $facilities_main = array($user->facility);

        } else {
            // load all facilities
            $facilities_main = \App\Models\Facility::all();
        }*/
        
        $query = \App\Models\Facility::query();

        if ($userRole !== 'super') {
            $query->where('id', $user->facility_id);
        }

        $facilities = $query
            ->with([
                'workgroups.workstations.displays' => function ($q) use ($workstation_app, $leaf) {

                if ($workstation_app) {
                    $q->whereHas('workstation', function ($ws) use ($workstation_app) {
                        $ws->where('app', 'LIKE', "{$workstation_app}%");
                    });
                }

                if ($leaf === 'di') {
                    $q->whereHas('preferences', function ($p) {
                        $p->where('name', 'exclude')
                        ->where('value', '0');
                    });
                }
            }
            ])
        ->get();
        
        $workgroups   = $facilities->pluck('workgroups')->flatten();
        $workstations = $workgroups->pluck('workstations')->flatten();
        $displays     = $workstations->pluck('displays')->flatten();
        
        //echo count($displays); exit();
        
        /*$facilities = array(); $workgroups=array(); $workstations=array(); $displays=array();
        foreach ($facilities_main as $f)
        {
            $facilities[]=$f;
            
            // Load workgroups
            foreach ($f->workgroups as $wg)
            {
                $workgroups[] = $wg;
                
                // Load workstations
                //$workstations = $wg->workstations()->where('app', 'LIKE', "{$workstation_app}%")->get();
                $workstations2 = $wg->workstations()->get();
                foreach ($workstations2 as $ws) {
                    $workstations[] = $ws;

                    // Load displays
                    if ($leaf == 'di') {
                        foreach ($ws->displays as $d) {
                            //$exclude = $d->preference('exclude');
                            $displays[]=$d;
                        }
                    }
                }

                
            }   
        }
        echo count($facilities); exit();*/
        
        return view('displays.display_settings', ['title'=>'Display Settings', 'workgroups'=>$workgroups, 'workstations'=>$workstations, 'facilities'=>$facilities, 'display_id'=>$display_id, 'facility_id'=>$facility_id, 'workgroup_id'=>$workgroup_id, 'workstation_id'=>$workstation_id]);
    }

    public function load_display_settings(Request $request, $id)
    {
        $id = str_replace('di-', '', $id);
        $id=$request->input('id');

        // $w = Workstation::find(1);

        $d = \App\Models\Display::find($id);
        $displays = $d->preferences;
        $w = $d->workstation;
        
        $data = [];
        $options = [];

        // get all display by display_id
        foreach($displays as $dis){
            $data[$dis->name] = $dis->value;
        }
        
        // add information into Financial Status
        $data['purchase_date'] = $d->purchase_date;
        $data['initial_value'] = $d->initial_value;
        $data['expected_value'] = $d->expected_value;
        $data['annual_straight_line'] = $d->annual_straight_line;
        $data['monthly_straight_line'] = $d->monthly_straight_line;
        $data['current_value'] = $d->current_value;
        $data['expected_replacement_date'] = $d->expected_replacement_date;
        $data['treeText'] = $d->treeText;
        // $data['IgnoreDisplay'] = $d->active;
        
        $setting = $w->settings_names()->whereIn('setting_name', ['TypeOfDisplay','DisplayTechnology','ScreenSize','BacklightStabilization'])->get();
        if ($setting) {
             foreach($setting as $s)
                $options[$s->setting_name] = $s->setting_value;
        }
        // get lut_names
        $lut_names = $d->preference('lut_names');
        if ($lut_names != 'N/A') {
            $a = explode('||', $lut_names);
        } else {
            $a = array();
        }
        $options['lut_names'] = json_encode($a);


        // 2019-01-13 convert InstalationDate to yyyy-mm-dd
        $data['InstalationDate'] = str_replace('.','-',$data['InstalationDate']);
        //  dd($data);
        return ['data' => $data, 'options' => $options];
    }

    public function save_display_settings(Request $request, $id)
    {
        $input = $request->except(['_token','ajax','id']);
        
        // DB::beginTransaction();
        $id = str_replace('di-','',$id);
        
        //update active in Display table
        $input['exclude'] = isset($input['exclude']) ? 1 : 0;
       

        // if uncheck CommunicateType
        if(!isset($input['CommunicationType'])){
            $input['CommunicationType'] = 3;
        }

        if(!isset($input['InternalSensor'])){
            $input['InternalSensor'] = "false";
        }
        else {
            $input['InternalSensor'] = "true";
        }

        foreach($input as $key => $data){
            //
            $d = \App\Models\DisplayPreference::where('display_id',[$id])->where('name',[$key])->first();
            // only save if changed
            if ($d == null){
                $d = \App\Models\DisplayPreference::create([
                    'name' => $key,
                    'value' => $data,
                    'display_id' => $id,
                    'sync' => 1
                ]);
            }
            if($d && $d->value != $data){
                $d->value = $data;
                $d->sync = 0;
                $d->save();
            }
        }
        

        //$facility = auth()->user()->facility;
        //activity()->by($facility)->performedOn($d)->withProperties(['key'=>'edited', 'user_id' => auth()->user()->id])->log('Display updated by : '. auth()->user()->name);

        return $d;
        
    }

    public function save_display_fn(Request $request, $id)
    {
        // $this->validate($request,[
        //     'initial_value'=> 'numeric|nullable',
        //     'expected_value' => 'numeric|nullable',
        //     'annual_straight_line' => 'numeric|nullable',
        //     'monthly_straight_line' => 'numeric|nullable',
        //     'current_value ' => 'numeric|nullable',
        //     'purchase_date' =>'date',
        //     'expected_replacement_date' =>'date'
        // ]);

        $id = str_replace('di-','',$id);
        $di = \App\Models\Display::find($id);
        if($di){
            $di->purchase_date = $request->input('purchase_date');
            $di->initial_value = $request->input('initial_value');
            $di->expected_value = $request->input('expected_value');
            $di->annual_straight_line = $request->input('annual_straight_line');
            $di->monthly_straight_line = $request->input('monthly_straight_line');
            $di->current_value = $request->input('current_value');
            $di->expected_replacement_date = $request->input('expected_replacement_date');
            $di->save();

        }
        //$facility = auth()->user()->facility;
        //activity()->by($facility)->performedOn($di)->withProperties(['key'=>'edited', 'user_id' => auth()->user()->id])->log('Financial Status updated by : '. auth()->user()->name);
        return json_encode($di);
    }
    
    public function fetch_data_settings(Request $request)
    {
        $id=$request->input('id');
        
        $data=array();
        $data['success']=0;
        $row=\App\Models\Display_preference::where('display_id', $id)->pluck('value', 'name')->toArray();
        
        $workstation_id=\App\Models\Display::where('id', $id)->pluck('workstation_id');
        $settings=\App\Models\SettingName::where('workstation_id', $workstation_id )->pluck('setting_value', 'setting_name')->toArray();
        
        $data['content']=view('displays.settings_form', ['row'=>$row, 'settings'=>$settings])->render();
        $displays=\App\Models\Display::where('id', $id)->first();
        
        
        $data['financial']=view('displays.financial_form', ['displays'=>$displays])->render();
        
        $data['display']='<h6 class="m-0 text-right mb-1" style="color:#049FD9 !important;">'.$displays->manufacturer.' '.$displays->model.' ('.$displays->serial.')</h6>
                                            <h6 class="m-0 text-right" style="font-weight:300; color:#808080;">'.$row["ResolutionHorizontal"].' X '.$row["ResolutionVertical"].'</h6>';
        
        $data['success']=1;
        return response()->json($data);
    }
}