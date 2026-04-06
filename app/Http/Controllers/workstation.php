<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class workstation extends Controller
{
    public function workstations(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        /*$workgroups_ids=\App\Models\Workgroup::where('user_id', $user_id)->pluck('id');
        $total_workstations=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->count();
        
        $workstations=array(); $i=0;
        $row=\App\Models\Workstation::whereIn('workgroup_id', $workgroups_ids)->get();
        foreach($row as $r){
            $workstations[$i]['item']=$r;
            
            $row2=\App\Models\Workgroup::where('id', $r->workgroup_id)->select('facility_id', 'name')->first();
            $workstations[$i]['workgroup']=$row2;
            
            $row2=\App\Models\Facility::where('id', $workstations[$i]['workgroup']->facility_id)->pluck('name');
            $workstations[$i]['facility']=$row2;
            
            $i++;
        }*/

        if($request->input('id')!='')
        {
            $id=$request->input('id');
            if($id=='0')
            {
                $item = new \App\Models\Workstation();
                $item->created_at=NOW();
                $request->session()->flash('success', 'Workstation created successfully!');
            }
            elseif($id!='0')
            {
                $item = \App\Models\Workstation::find($id);
                $item->updated_at=NOW();
                $request->session()->flash('success', 'Workstation updated successfully!');
            }

                $item->name = $request->input('name');
                //$item->city = $request->input('city');
                //$item->state = $request->input('state');
                //$item->postcode = $request->input('postcode');
                //$item->fax = $request->input('fax');
                $item->user_id = $user->id;
                $item->workgroup_id = $request->input('workgroup_id');
                $item->save();

            return redirect('workstations');
        }

        $workgroup_id = request('workgroup_id')?request('workgroup_id'):'';
        $items = \App\Models\Workstation::with('workgroup.facility');

        $items->when($workgroup_id, function($q) use ($workgroup_id) {
            return $q->where('workgroup_id','=',$workgroup_id);
        });
        
        $facility_id = $user->facility_id;

        return view('workstations.workstations', ['title'=>'Workstations']);
    }

    public function list_workstations(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $workgroup_id = request('workgroup_id')?request('workgroup_id'):'';
        $items = \App\Models\Workstation::with('workgroup.facility');

        $items->when($workgroup_id, function($q) use ($workgroup_id) {
            return $q->where('workgroup_id','=',$workgroup_id);
        });
        
        $facility_id = $user->facility_id;
        $items->when($facility_id, function($q) use ($facility_id) {
            return $q->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')
                     ->where('workgroups.facility_id','=',$facility_id);
        })->select('workstations.*');
        
        return Datatables::of($items)
                ->rawColumns(['link', 'workgroup.link', 'workgroup.facility.link'])
                ->make(true);
        // $workgroup_id = request('workgroup_id')?request('workgroup_id'):'';
        // if (auth()->user()->hasRole('admin')) {
        //     if ($workgroup_id!='') {
        //         $items = auth()->user()->facility->workstations()->With(['Workgroup.Facility'])->where('workgroup_id', $workgroup_id)->latest()->get();
        //     } else {
        //         $items = auth()->user()->facility->workstations()->With(['Workgroup.Facility'])->latest()->get();
        //     }
            
        // } else {
        //     if ($workgroup_id!='') {
        //         $items = Workstation::With(['Workgroup.Facility'])->where('workgroup_id', $workgroup_id)->latest()->get();  
        //     } else {
        //         $items = Workstation::With(['Workgroup.Facility'])->latest()->get();      
        //     }
        // }
       
        // return Datatables::of($items)
        //             ->rawColumns(['link', 'workgroup.link', 'workgroup.facility.link'])
        //             ->make(true);
    }

    public function form(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $data=array();
        $id=$request->input('id');
        $isSuper = $user->hasRole('super');

        $facility_id = request('facility_id')?request('facility_id'):$user->facility_id;

        if($isSuper)
        $workgroups = \App\Models\Workgroup::with('facility')->pluck('name', 'id')->toArray();
        else
        $workgroups = \App\Models\Workgroup::with('facility')->where('facility_id', $facility_id)->pluck('name', 'id')->toArray();

        $item = \App\Models\Workstation::find($id);
        
        $facilities = \App\Models\Facility::when(!$isSuper, function ($q) use ($user) {
            return $q->where('id', $user->facility_id);
        })->orderBy('id')->pluck('name', 'id')->toArray();

        if(!isset($item->id))
        {
            $item = \App\Models\Workstation::limit(1)->get();
            $item->id=0;
            $item->name='';
            $item->address='';
            $item->phone='';
            $item->workgroup_id=0;
            $item->facility_id=0;
        }

        $data['success']=1;
        $data['content']=view('workstations.form')->with('item', $item)->with('facilities', $facilities)->with('workgroups', $workgroups)->render();

        return response()->json($data);
    }

    public function delete_workstation(Request $request)
    {
        $data=array();
        $data['success']=0;
        $data['msg']='';
        $id=$request->input('id');

        $item = \App\Models\Workstation::findOrFail($id);
        $fid = $item->facility_id;
        if (($item->displays->count()) > 0) {
            $data['msg']='Record cannot be deleted, because there are displays belong to this workstation!';
            return response()->json($data);
        }
        // $facility = auth()->user()->facility;
        // activity()->by($facility)->performedOn($item)->withProperties(['key'=>'deleted', 'user_id' => auth()->user()->id])->log('Workgroup deleted by : '. auth()->user()->name);
        $item->delete();
        $data['msg']='Workstation deleted successfully!';
        $data['success']=1;

        return response()->json($data);
    }
    
    public function workstations_info(Request $request, $id)
    {
        $item = \App\Models\Workstation::find($id);
      
        //return view('workstations.show')->with('item', $item);
        
        return view('workstations.information', ['title'=> 'Workstation Information', 'item' => $item]);
    }
}
