<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class histories extends Controller
{
    public function histories(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        $role=$request->session()->get('role');
        
        $cacheKey = '';
        if ($role!='super') { // load current facility only
            $facilities = array($user->facility);
            //var_dump($facilities); exit();

        } else { // load all facilities
            $facilities = \App\Models\Facility::all();
        }
        
        return view('histories.index', ['title' =>'Histories & Reports', 'facilities'=>$facilities]);
    }
    
    public function list_histories(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $facility_id = $user->facility_id;
        $timezone=$user->timezone;

        $facility_id2 = $request->input('facility_id');
        if($facility_id2) $facility_id=$facility_id2;
        $workstation_id = $request->input('workstation_id');
        $workgroup_id = $request->input('workgroup_id');
        $displays_ids = $request->input('displays');
        if($displays_ids) $display_ids=$displays_ids;

        $history_data = \App\Models\History::with('display.workstation.workgroup.facility')->has('display');

        // Apply display ID filter if $id array is provided
        if (!empty($display_ids))
        {
            $history_data->whereIn('display_id', $display_ids);
        }

        // Apply filters and joins if any of the facility, workstation, or workgroup IDs are set
        $history_data
                ->join('displays', 'displays.id', '=', 'histories.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id');
                
        if ($facility_id || $workstation_id || $workgroup_id) {
            if ($facility_id) {
                $history_data->where('workgroups.facility_id', '=', $facility_id);
            }

            if ($workstation_id) {
                $history_data->where('displays.workstation_id', '=', $workstation_id);
            }

            if ($workgroup_id) {
                $history_data->where('workstations.workgroup_id', '=', $workgroup_id);
            }
        }

        $history_data->select('histories.*');

        return \Datatables::of($history_data)
            ->rawColumns(['time', 'result', 'resultIcon', 'link', 'display.link', 'display.workstation.link', 'display.workstation.workgroup.link', 'display.workstation.workgroup.facility.link'])
            ->editColumn('time', function ($history) {
                return '<span style="display:none;">' . $history->time . '</span>' . date('d/m/Y H:i', $history->time);
            })
            ->make(true);
            /*
            ->editColumn('time', function ($history) use ($timezone) {
                $formatted = Carbon::createFromTimestampUTC($history->time)
                ->tz($timezone)
                ->format('d/m/Y H:i');

                return '<span style="display:none;">' . $history->time . '</span>' . $formatted;
            })
            */
    }

    public function view_histories(Request $request, $id)
    {
        $graph = $request->input('graph');
        if ($graph) {
            $graph = json_decode($graph, true);
        } else {
            $graph = [];
        }
        //$item = \App\Models\History::with('display.workstation.workgroup')->find($id);
        $item = \App\Models\History::find($id);
        $item->load('display.workstation.workgroup');
        
        //$version = File::get(base_path().'/version.txt');

        //$pdf = \PDF::loadView('histories.pdf',  compact('item', 'graph', 'version'));
        
        //$item = \App\Models\History::find($id);
        return view('histories.view', ['title'=>'History Information'])->with('item', $item);
    }
}
