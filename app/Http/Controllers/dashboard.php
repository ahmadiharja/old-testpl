<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class dashboard extends Controller
{
    public function dashboard(Request $request){

        //$request->session()->put('id', '32');
        
        $data=array();
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        //$workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        //$workstations_ids=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->pluck('id');
        
        //$displays_id=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->pluck('id');

        $facility_id = $user->facility_id;

        $displays = \App\Models\Display::when($facility_id, function ($q) use ($facility_id) {
            return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })
            ->join('display_preferences', 'display_preferences.display_id', '=', 'displays.id')
            ->where(['display_preferences.name' => 'exclude', 'display_preferences.value' => '0'])
            ->select('displays.*')->get();
        
        $d_ok=$displays->filter(function ($d, $key) {
            return $d->status == 1;
        })->count();
        $d_fail=$displays->filter(function ($d, $key) {
            return $d->status == 2;
        })->count();
        
        $d_fail_recent=array(); $i=0;
            
        //$workstations=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->count();
        $workstations = \App\Models\Workstation::when($facility_id, function ($q) use ($facility_id) {
            return $q->join('workgroups', 'workgroups.id', '=', 'workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })
            ->count();
        
        //$display_ids=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->pluck('id');
        
        
        //total due tasks
        $ids = request()->input('id') ? explode(',', request()->input('id')) : [];

        
        $due_tasks_recents=0; $due_tasks=0;
            
        return view('dashboard.dashboard', ['d_ok'=>$d_ok, 'd_fail'=>$d_fail, 'workstations'=>$workstations, 'due_tasks'=>$due_tasks, 'title'=>'Dashboard', 'd_fail_recent'=>$d_fail_recent, 'due_tasks_recents'=>$due_tasks_recents]);   
    }

    public function search(Request $request)
    {
        return view('dashboard.search', ['title'=>'Search']);
    }
    
    public function update_sidebar(Request $request)
    {
        $user_id=$request->session()->get('id');
        $sidebar=$request->input('sidebar');
        
        $user=\App\Models\User::find($user_id);
        $user->sidebar=$sidebar;
        $user->save();
    }
   
    public function d_fail(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        /*$workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        $workstations_ids=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->pluck('id');
        $d_fail=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','2'], ['is_deleted', '0']])->count();
        $d_fail_recent=array(); $i=0;
        $row=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','2'], ['is_deleted', '0']])->limit(5)->orderBy('id', 'DESC')->get();
        foreach($row as $r)
        {
            $d_fail_recent[$i]['item']=$r;
            
            $workgroup_id=\App\Models\Workstation::where('id', $r->workstation_id)->pluck('workgroup_id');
            $workgroup_data=\App\Models\Workgroup::where('id', $workgroup_id)->get();
            $workgroup_data=collect($workgroup_data)->first();
            
            $d_fai_recentl[$i]['workgroup']=$workgroup_data;
            
            $i++;
        }*/

        $facility_id = $user->facility_id;

        $d_fail_recent = \App\Models\Display::when($facility_id, function ($q) use ($facility_id) {
            return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })
            ->join('display_preferences', 'display_preferences.display_id', '=', 'displays.id')
            ->where(['display_preferences.name' => 'exclude', 'display_preferences.value' => '0', 'status' => '2'])
            ->select('displays.*')->get();
        
        //$d_ok=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','1'], ['is_deleted', '0']])->count();
        $d_fail=count($d_fail_recent);
        
        return view('dashboard.d_fail', ['title'=>'Display Not Ok', 'd_fail_recent'=>$d_fail_recent, 'd_fail'=>$d_fail]);
    }
    
    public function d_ok(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        /*$workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        $workstations_ids=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->pluck('id');
        $d_ok=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','1'], ['is_deleted', '0']])->count();
        
        $d_ok_recent=array(); $i=0;
        $row=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','1'], ['is_deleted', '0']])->limit(5)->get();
        
        foreach($row as $r)
        {
            $d_ok_recent[$i]['item']=$r;
            $workgroup_id=\App\Models\Workstation::where('id', $r->workstation_id)->pluck('workgroup_id');
            $workgroup_data=\App\Models\Workgroup::where('id', $workgroup_id)->get();
            $workgroup_data=collect($workgroup_data)->first();
            
            $d_ok_recent[$i]['workgroup']=$workgroup_data;
            $i++;
        }*/

        $facility_id = $user->facility_id;

        $d_ok_recent = \App\Models\Display::when($facility_id, function ($q) use ($facility_id) {
            return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })
            ->join('display_preferences', 'display_preferences.display_id', '=', 'displays.id')
            ->where(['display_preferences.name' => 'exclude', 'display_preferences.value' => '0', 'status' => '1'])
            ->select('displays.*')->get();
        
        //$d_ok=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->where([['status','1'], ['is_deleted', '0']])->count();
        $d_ok=count($d_ok_recent);

        return view('dashboard.d_ok', ['title'=>'Display Ok', 'd_ok_recent'=>$d_ok_recent, 'd_ok'=>$d_ok]);
    }

    public function list_displays_failed(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        $facility_id = $user->facility_id;
        $items = \App\Models\Display::with('workstation.workgroup.facility')
            ->join('display_preferences', 'display_preferences.display_id', '=', 'displays.id')
            ->where(['status' => 2, 'display_preferences.value' => 0, 'display_preferences.name' => 'exclude'])
            // ->wherestatus(Display::STATUS_FAILED)
            ->take(10)
            ->when($facility_id, function ($q) use ($facility_id) {
                return $q->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id);
            })
            // ->take(10)
            ->select('displays.*');



        return Datatables::of($items)
            ->addColumn('lasthistory', function (\App\Models\Display $display) {
                $histories = json_decode($display->errors);
                if (count($histories) > 0) {
                    // $history = History::find($histories[0]);
                    $history = \App\Models\History::where(['result' => 3, 'display_id' => $display->id])->latest('updated_at')->first();
                    return $history? $history->id: '';
                    return $history? $history->link: '';
                }
                return '';
            })
            ->addColumn('error_type', function (\App\Models\Display $display) {
                $histories = json_decode($display->errors);
                if (count($histories) > 0) {
                    return $display->errors;
                }
                return '';
            })
            ->rawColumns([
                'lasthistory', 'history_link', 'workstation.link',
                'workstation.workgroup.link', 'workstation.workgroup.facility.link'
            ])
            ->make(true);
    }

    public function list_due_tasks(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $facility_id = $user->facility_id;
        $task = \App\Models\Task::has('display')
            ->join('task_types', 'tasks.type', '=', 'task_types.key')
            ->join('schedule_types', 'tasks.schtype', '=', 'schedule_types.client_id')
            ->join('displays', 'displays.id', '=', 'tasks.display_id')
            ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
            ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
            ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id')
            // ->where(['tasks.status' => 1])
            ->where('nextrun', '>', 0)
            ->where([
                // 'type' => 'cal', 
                'deleted' => 0, 
                'disabled' => 0
                ])
            ->take(10);

        $task->when($facility_id, function ($q) use ($facility_id) {
            return $q->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('"task" as type, tasks.id as id, task_types.title as name, schedule_types.title as schtype, 
                                displays.id as d_id, 
                                workstations.id as ws_id, 
                                workgroups.id as wg_id, 
                                facilities.id as f_id,
                                tasks.startdate as startdate1,
                                tasks.nextrun as nextrun,
                                tasks.nextrun as duedate_sort,
                                (case 
                                        when tasks.schtype=0 THEN \'9999-12-31\'
                                        when (tasks.startdate IS NULL OR tasks.nextrun IS NULL OR tasks.nextrun=0) THEN 0
                                        else FROM_UNIXTIME(tasks.nextrun)
                                    end) as duedate'));

        $qatasks = \App\Models\QATask::has('display')
            ->join('displays', 'displays.id', '=', 'qa_tasks.display_id')
            ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
            ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
            ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id')
            // ->where(['taskStatus' => 1])
            ->where('nextdate', '>', 0)
            ->take(10);

        $qatasks->when($facility_id, function ($q) use ($facility_id) {
            return $q->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('"qa_task" as type,qa_tasks.id as id, qa_tasks.name as name, qa_tasks.freq as schtype, 
                            displays.id as d_id, 
                            workstations.id as ws_id, 
                            workgroups.id as wg_id, 
                            facilities.id as f_id,
                            "2019-08-27 00:00" as startdate1,
                            nextdate as nextrun,
                            nextdate as duedate_sort,
                            nextdate as duedate'));


        return Datatables::of($task->union($qatasks))
            ->orderColumn('duedate', 'duedate_sort $1')
            ->addColumn('display', function ($t) {
                return \App\Models\Display::find($t->d_id)->link;
            })
            ->addColumn('workstation', function ($t) {
                return \App\Models\Workstation::find($t->ws_id)->link;
            })
            ->addColumn('workgroup', function ($t) {
                return \App\Models\Workgroup::find($t->wg_id)->link;
            })
            ->addColumn('facility', function ($t) {
                return \App\Models\Facility::find($t->f_id)->link;
            })
            ->rawColumns(['error', 'ScheduleType.title', 'display', 'workstation', 'workgroup', 'facility'])
            ->make(true);
    }
    
    public function due_tasks(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        $workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        $workstations_ids=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->pluck('id');
        $display_ids=\App\Models\Display::whereIn('workstation_id', $workstations_ids)->pluck('id');
        //total due tasks
        //$due_tasks=\App\Models\Task::whereIn('display_id', $display_ids)->where([['deleted','0'], ['disabled', '0']])->get();
        
        /*$due_tasks_recents=array(); $i=0;
        $row=\App\Models\Task::whereIn('display_id', $display_ids)->where([['nextrun', '>', '0'], ['deleted','0'], ['disabled', '0']])->limit(5)->orderBy('nextrun', 'DESC')->get();
        foreach($row as $dt)
        {
            $due_tasks_recents[$i]['item']=$dt;
            
            //schedule type
            $row2=\App\Models\ScheduleType::where('client_id', $dt->schtype)->pluck('title');
            $due_tasks_recents[$i]['schedule_type']=$row2;
            
            //task type
            $row2=\App\Models\TaskType::where('key', $dt->type)->pluck('title');
            $due_tasks_recents[$i]['task_type']=$row2;
            
            //display
            $row2=\App\Models\Display::where('id', $dt->display_id)->select('manufacturer', 'model', 'serial', 'workstation_id')->first();
            $due_tasks_recents[$i]['display']=$row2;
            
            //workstations
            $row2=\App\Models\Workstation::where('id', $due_tasks_recents[$i]['display']->workstation_id)->select('name', 'workgroup_id')->first();
            $due_tasks_recents[$i]['workstations']=$row2;
            
            //workgroups
            $row2=\App\Models\Workgroup::where('id', $due_tasks_recents[$i]['workstations']->workgroup_id)->pluck('name');
            $due_tasks_recents[$i]['workgroups']=$row2;
            
            $i++;
        }*/

        $ids = request()->input('id') ? explode(',', request()->input('id')) : [];
        $task = \App\Models\Task::with(['ScheduleType', 'taskType', 'display.workstation.workgroup.facility'])
            ->where([['deleted', 0], ['type', 'cal']])
            ->has('display');
        $task->when(count($ids) > 0, function ($q) use ($ids) {
            return $q->whereIn('display_id', $ids);
        });

        $facility_id = $user->facility_id;

        $task->when($facility_id, function ($q) use ($facility_id) {
            return $q->join('displays', 'displays.id', '=', 'tasks.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('tasks.*,tasks.startdate as startdate1'));

        $due_tasks=$task->count();

        $due_tasks_recents=Datatables::of($task)
            ->rawColumns(['ScheduleType.title', 'display.link', 'display.workstation.link', 'display.workstation.workgroup.link', 'display.workstation.workgroup.facility.link'])
            ->make(true);
        
        return view('dashboard.due_tasks', ['title'=>'Schedule Tasks', 'due_tasks'=>$due_tasks, 'due_tasks_recents'=>$due_tasks_recents->getData()->data]);
    }
}
