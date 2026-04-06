<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\SettingsName;
use \App\Models\Task;
use \App\Models\ScheduleType;
use \App\Models\TestPattern;
use \App\Models\TaskType;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;

class tasks extends Controller
{
    public function list_tasks(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $facility_id = $user->facility_id;
        $ids = request()->input('id') ? explode(',', request()->input('id')) : [];
        $facility_id2 = $request->input('facility_id');
        if($facility_id2) $facility_id=$facility_id2;
        $workstation_id = $request->input('workstation_id');
        $workgroup_id = $request->input('workgroup_id');
        $displays_ids = $request->input('displays');
        if($displays_ids) $ids=$displays_ids;

        //$facility=\App\Models\Facility::find($facility_id);
        //$timezone = $facility->timezone;
        $search = $request->input('search.value');
        $searchTimestamp = null;
        if ($search && \DateTime::createFromFormat('d/m/Y H:i', $search)) {
            $searchTimestamp = \DateTime::createFromFormat('d/m/Y H:i', $search)->getTimestamp();
        }
        
        $terms = $search ? preg_split('/\s+/', trim($search)) : [];

        $task = \App\Models\Task::has('display')
            ->join('task_types', 'tasks.type', '=', 'task_types.key')
            ->join('schedule_types', 'tasks.schtype', '=', 'schedule_types.client_id')
            ->join('displays', 'displays.id', '=', 'tasks.display_id')
            ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
            ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
            ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id')
            ->where(['deleted' => 0, 'disabled' => 0])
            ->where('nextrun', '>', 0)
            ->when($searchTimestamp, fn($q) => $q->where('tasks.nextrun', $searchTimestamp));

        $task->when(count($ids) > 0, function ($q) use ($ids) {
            return $q->whereIn('display_id', $ids);
        });
        
        $task->when(!empty($terms), function ($query) use ($terms) {
            
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
    
        /*
        $query->where(function ($q) use ($search) {
            $q->where('task_types.title', 'like', "%{$search}%")
              ->orWhere('displays.manufacturer', 'like', "%{$search}%")
              ->orWhere('displays.model', 'like', "%{$search}%")
              ->orWhere('displays.serial', 'like', "%{$search}%")
              ->orWhere('schedule_types.title', 'like', "%{$search}%")
              ->orWhere('facilities.name', 'like', "%{$search}%")
              ->orWhere('workstations.name', 'like', "%{$search}%")
              ->orWhere('workgroups.name', 'like', "%{$search}%");
        });*/
});

        if ($workstation_id) {
            $task->where('displays.workstation_id', '=', $workstation_id);
        }
        if ($workgroup_id) {
            $task->where('workstations.workgroup_id', '=', $workgroup_id);
        }

        $task->when($facility_id, function ($q) use ($facility_id) {
            return $q->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('"task" as type, tasks.id as id, task_types.title as name, schedule_types.title as schtype, 
                                displays.id as d_id, 
                                workstations.id as ws_id, 
                                workgroups.id as wg_id, 
                                facilities.id as f_id,
                                tasks.startdate as startdate1,
                                tasks.nextrun as nextrun,
                                tasks.nextrun as due_date_sort,
                                (case 
                                        when tasks.schtype=0 THEN \'9999-12-31\'
                                        when (tasks.startdate IS NULL OR tasks.nextrun IS NULL OR tasks.nextrun=0) THEN 0
                                        else FROM_UNIXTIME(tasks.nextrun)
                                    end) as duedate'));
        // Get QA tasks
        $qatasks = \App\Models\QATask::has('display')
            ->join('displays', 'displays.id', '=', 'qa_tasks.display_id')
            ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
            ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
            ->join('facilities', 'facilities.id', '=', 'workgroups.facility_id')
            ->where('nextdate', '>', 0)
            ->where(['deleted' => 0])
            ->when($searchTimestamp, fn($q) => $q->where('qa_tasks.nextdate', $searchTimestamp));

        $qatasks->when(count($ids) > 0, function ($q) use ($ids) {
            return $q->whereIn('display_id', $ids);
        });

        $qatasks->when($facility_id, function ($q) use ($facility_id) {
            return $q->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('"qa_task" as type,qa_tasks.id as id, qa_tasks.name as name, qa_tasks.freq as schtype, 
                                displays.id as d_id, 
                                workstations.id as ws_id, 
                                workgroups.id as wg_id, 
                                facilities.id as f_id,
                                "2019-08-27 00:00" as startdate1,
                                nextdate as nextrun,
                                nextdate as due_date_sort,
                                nextdate as duedate'));
                                
        $qatasks->when(!empty($terms), function ($query) use ($terms) {
            $query->where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('qa_tasks.name', 'like', "%{$term}%")
              ->orWhere('displays.manufacturer', 'like', "%{$term}%")
              ->orWhere('displays.model', 'like', "%{$term}%")
              ->orWhere('displays.serial', 'like', "%{$term}%")
              ->orWhere('facilities.name', 'like', "%{$term}%")
              ->orWhere('workstations.name', 'like', "%{$term}%")
              ->orWhere('workgroups.name', 'like', "%{$term}%");
                });
            }
        });
    
        /*
        $query->where(function ($q) use ($search) {
            $q->where('qa_tasks.name', 'like', "%{$search}%")
              ->orWhere('displays.manufacturer', 'like', "%{$search}%")
              ->orWhere('displays.model', 'like', "%{$search}%")
              ->orWhere('displays.serial', 'like', "%{$search}%")
              ->orWhere('facilities.name', 'like', "%{$search}%")
              ->orWhere('workstations.name', 'like', "%{$search}%")
              ->orWhere('workgroups.name', 'like', "%{$search}%");
        });*/
    
});

        return Datatables::of($task->unionAll($qatasks))
        ->filter(function ($query) use ($request) {
            // Check if there's a search term
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
            }
        })
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
            ->addColumn('edit_url', function ($t) {
                return $t->type=='qa_task'? 'qa_task': '';
            })
            ->addColumn('delete_url', function ($t) {
                return $t->type=='qa_task'? 'qa_task': 'tasks';
            })
            //->editColumn('duedate', function($t) {
              //  if ($t->type == 'qa_task') {
                //    return \App\Models\QATask::find($t->id)->duedate;
                //}
                //return $t->duedate;
            //})
            ->rawColumns(['display', 'workstation', 'workgroup', 'facility'])
            ->make(true);
    }

    public function list_tasks2(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $ids = request()->input('id') ? explode(',', request()->input('id')) : [];
        $facility_id2 = $request->input('facility_id');
        if($facility_id2) $facility_id=$facility_id2;
        $workstation_id = $request->input('workstation_id');
        $workgroup_id = $request->input('workgroup_id');
        $displays_ids = $request->input('displays');
        if($displays_ids) $ids=$displays_ids;

        $task = \App\Models\Task::with(['ScheduleType', 'taskType', 'display.workstation.workgroup.facility'])
            ->where(['type' => 'cal', 'deleted' => 0])
            ->has('display');

        $task->when(count($ids) > 0, function ($q) use ($ids) {
            return $q->whereIn('display_id', $ids);
        });

        $facility_id = $user->facility_id;

        if ($workstation_id) {
            $task->where('displays.workstation_id', '=', $workstation_id);
        }
        if ($workgroup_id) {
            $task->where('workstations.workgroup_id', '=', $workgroup_id);
        }

        $task->when($facility_id, function ($q) use ($facility_id) {
            return $q->join('displays', 'displays.id', '=', 'tasks.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                ->where('workgroups.facility_id', '=', $facility_id);
        })->select(DB::raw('tasks.*,tasks.startdate as startdate1, nextrun as due_date_sort'));

        return Datatables::of($task)
            ->rawColumns(['ScheduleType.title', 'display.link', 'display.workstation.link', 'display.workstation.workgroup.link', 'display.workstation.workgroup.facility.link'])
            ->make(true);
    }

    public function edit_task(Request $request)
    {
        $id=$request->input('id');
        if($id=='' OR $id==NULL) $id=0;
        $tasktype = TaskType::where('status', 1)->orderBy('id')->pluck('title', 'key')->toArray();
        $testpattern = TestPattern::where('status', 1)->orderBy('id')->pluck('title', 'value')->toArray();
        $scheduletype = ScheduleType::orderBy('id')->pluck('title', 'client_id')->toArray();

        $dayofweek = SettingsName::wheresetting_name('DaysOfWeek')->first();
        if ($dayofweek) {
            $dayofweek = json_decode($dayofweek['setting_value'], true);
        } else {
            $dayofweek = json_decode('{"1":"Monday","2":"Tuesday","3":"Wednesday","4":"Thursday","5":"Friday","6":"Saturday","7":"Sunday"}');
        }


        $weekly = SettingsName::wheresetting_name('WeekOfMonth')->first();
        if ($weekly) {
            $weekly = json_decode($weekly['setting_value'], true);
        } else {
            $weekly = json_decode('{"1":"First","2":"Second","3":"Third","4":"Fourth","5":"Last"}');
        }



        $monthly = SettingsName::wheresetting_name('Monthes')->first();
        if ($monthly) {
            $monthly = json_decode($monthly['setting_value'], true);
        } else {
            $monthly = json_decode('{"1":"January","2":"February","3":"March","4":"April","5":"May","6":"June","7":"July","8":"August","9":"September","10":"October","11":"November","12":"December"}');
        }


        // $task = Task::with('display')->find($id);
        $task = Task::With(['Display'])->find($id);
        if(!isset($task->id))
        {
            $task=new Task;
            $task->id=0;
            $task->type='cal';
            $task->schtype='0';
            $task->testpattern='SMPTE';
            $task->startdate=date('Y-m-d');
            $task->starttime=date('H:i');
        }

        $displays='';
        if($request->input('displays')!='')
        $displays=implode(';', $request->input('displays'));

        $data2 = array(
            'tasktype' => $tasktype,
            'testpattern' => $testpattern,
            'scheduletype' => $scheduletype,
            'weekly' => $weekly,
            'dayofweek' => $dayofweek,
            'monthly' => $monthly,
            'task' => $task,
            'displays' => $displays,
            'request' => $request
        );

        $data=array();
        //return view("tasks.edit")->with($data);
        $data['content']=view("tasks.edit")->with($data2)->render();
        $data['success']=1;
        // return view('schedule.create');
        return response()->json($data);
    }

    public function update_task(Request $request)
    {
        $data=array();
        $data['success']=0;
        $id=$request->input('id');
        //
        $this->validate($request, [
            'tasktype' => 'required',
            'scheduletype' => 'required'
        ]);
        // $ids = $id;
        $workstation_id=$request->input('workstation2');
        $workgroup_id=$request->input('workgroup2');

        if($id=='0')
        {
            if($request->input('displays')!='')
                $displayIds = explode(';', $request->input('displays'));
            elseif($workgroup_id==null AND $workstation_id==null)
                {
                    $facility_id=$request->input('facility2');
                    $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->pluck('displays.id');
                    $displayIds=$items;
                }
            elseif($workstation_id==NULL)
            {
                $facility_id=$request->input('facility2');
                $workgroup_id=$request->input('workgroup2');
                $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->where('workgroups.id', '=', $workgroup_id)   // Filter by workgroup_id
                    ->pluck('displays.id');
                $displayIds=$items;
            }
            else
            {
                $facility_id=$request->input('facility2');
                $workgroup_id=$request->input('workgroup2');
                $workstation_id=$request->input('workstation2');
                $items = \App\Models\Display::join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                    ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                    ->where('workgroups.facility_id', '=', $facility_id)
                    ->where('workgroups.id', '=', $workgroup_id)   // Filter by workgroup_id
                    ->where('workstations.id', '=', $workstation_id)  // Filter by workstation_id
                    ->pluck('displays.id');
                $displayIds=$items;
            }

            foreach ($displayIds as $displayId) {
                $task = new Task();
                $task->display_id = $displayId;
                $this->setTask($task, $request);
                $dat=$request->input('startdate').' '.$request->input('starttime');
                $task->nextrun = Carbon::createFromFormat('Y-m-d H:i', $dat)->timestamp;
                $task->save();
            }
        }
        else
        {
            // Get task by id
            $task = Task::find($id);
            $this->setTask($task, $request);
            $task->save();
        }

        //$facility = auth()->user()->facility;
        //activity()->by($facility)->performedOn($task)->withProperties(['key'=>'edited', 'user_id' => auth()->user()->id])->log('Task edited by : '. auth()->user()->name);

        //return $task;

        $data['success']=1;
        return response()->json($data);
    }

    public function delete_task(Request $request){
        $data=array();
        $data['success']=0;

        $id=$request->input('id');
        
        $item = \App\Models\Task::findOrFail($id);
        $item->deleted = 1;
        $item->sync = 0;
        $item->save();

        $data['msg']="Task deleted successfully!";
        $data['success']=1;

        return response()->json($data);
        
    }

    private function setTask($task, $request)
    {
        $user_id=$request->session()->get('id');
        //$timezone = \App\Models\User::find($user_id)->facility->timezone;
        $timezone = $task->display->workstation->workgroup->facility->timezone;

        // Set common attributes (type, schtype, testpattern, startdate, starttime, disabled, status, sync, deleted, userid)
        $task->type = $request->input('tasktype');
        $task->testpattern = $request->input('testpattern') ? $request->input('testpattern') : 'SMPTE';
        $task->schtype = $request->input('scheduletype');
        $task->disabled = $request->input('disabletask') ? 1 : 0;
        //$task->status = 0;
        $task->sync = 0;
        $task->deleted = 0;

        // Set specified attributes by schtype 
        $task->starttime = $request->input('starttime') ? $request->input('starttime') : Carbon::now($timezone)->format('H:i');
        $task->startdate = $request->input('startdate') ? $request->input('startdate') : Carbon::now($timezone)->format('Y-m-d');
        $task->setDayOption($request);

        return true;
    }
}
