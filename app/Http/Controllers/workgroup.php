<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class workgroup extends Controller
{
    public function workgroups(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $facility_ids=\App\Models\Facility::where('user_id', $user_id)->pluck('id');
        $total_workgroups=\App\Models\Workgroup::whereIn('facility_id', $facility_ids)->count();

        if($request->input('id')!='')
        {
            $id=$request->input('id');
            if($id=='0')
            {
                $item = new \App\Models\Workgroup();
                $item->created_at=NOW();
                $request->session()->flash('success', 'Workgroup created successfully!');
            }
            elseif($id!='0')
            {
                $item = \App\Models\Workgroup::find($id);
                $item->updated_at=NOW();
                $request->session()->flash('success', 'Workgroup updated successfully!');
            }

                $item->name = $request->input('name');
                $item->address = $request->input('address');
                //$item->city = $request->input('city');
                //$item->state = $request->input('state');
                //$item->postcode = $request->input('postcode');
                $item->phone = $request->input('phone');
                //$item->fax = $request->input('fax');
                $item->user_id = $user->id;
                $item->facility_id = $request->input('facility_id');
                $item->save();

            return redirect('workgroups');
        }
        
        /*$workgroups=array(); $i=0;
        $row=\App\Models\Workgroup::whereIn('facility_id', $facility_ids)->limit(5)->get();
        foreach($row as $r){
            $workgroups[$i]['item']=$r;
            
            $row2=\App\Models\facility::where('user_id', $user_id)->pluck('name');
            $workgroups[$i]['facility']=$row2;
            
            $i++;
        }*/

        //$workgroups = \App\Models\Workgroup::find($id);
        //$facilities = \App\Models\Facility::orderBy('id')->limit(5)->pluck('name','id')->toArray();

        $facility_id = request('facility_id')?request('facility_id'):$user->facility_id;

        return view('workgroups.workgroups', ['title'=>'Workgroups']);
    }

    public function list_workgroups(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $facility_id = request('facility_id')?request('facility_id'):$user->facility_id;
        $items = \App\Models\Workgroup::with('facility');

        $items->when($facility_id, function($q) use ($facility_id) {
            return $q->where('facility_id','=',$facility_id);
        })->select('workgroups.*');

        return Datatables::of($items)
                ->rawColumns(['link','facility.link'])
                ->make(true);

        // $facility_id = request('facility_id')?request('facility_id'):'';

        // if (auth()->user()->hasRole('admin')) {
        //     if ($facility_id!='') {
        //         $items = auth()->user()->facility->workgroups()->With('Facility')->where('facility_id', $facility_id)->latest()->get();        
        //     } else {
        //         $items = auth()->user()->facility->workgroups()->With('Facility')->latest()->get();        
        //     }
            
        // } else {
        //     if ($facility_id!='') {
        //         $items = Workgroup::With('Facility')->where('facility_id', $facility_id)->latest()->get();        
        //     } else {
        //         $items = Workgroup::With('Facility')->latest()->get();            
        //     }
        // }
        // return Datatables::of($items)
        //         ->rawColumns(['link','facility.link'])
        //         ->make(true);
    }

    public function delete_workgroup(Request $request)
    {
        $data=array();
        $data['success']=0;
        $data['msg']='';
        $id=$request->input('id');

        $item = \App\Models\Workgroup::findOrFail($id);
        $fid = $item->facility_id;
        if (($item->workstations->count()) > 0) {
            $data['msg']='Record cannot be deleted, because there are workstations belong to this workgroup!';
            return response()->json($data);
        }
        // $facility = auth()->user()->facility;
        // activity()->by($facility)->performedOn($item)->withProperties(['key'=>'deleted', 'user_id' => auth()->user()->id])->log('Workgroup deleted by : '. auth()->user()->name);
        $item->delete();
        $data['msg']='Workgroup deleted successfully!';
        $data['success']=1;

        return response()->json($data);
    }

    public function form(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        $data=array();
        $id=$request->input('id');

        $item = \App\Models\Workgroup::find($id);
        $isSuper = $user->hasRole('super');
        $facilities = \App\Models\Facility::when(!$isSuper, function ($q) use ($user) {
            return $q->where('id', $user->facility_id);
        })->orderBy('id')->pluck('name', 'id')->toArray();

        if(!isset($item->id))
        {
            $item = \App\Models\Workgroup::limit(1)->get();
            $item->id=0;
            $item->name='';
            $item->address='';
            $item->phone='';
            $item->facility_id=0;
        }

        $data['success']=1;
        $data['content']=view('workgroups.form')->with('item', $item)->with('facilities', $facilities)->render();

        return response()->json($data);
    }
    
    public function workgroups_info(Request $request, $id)
    {
        $item = \App\Models\Workgroup::find($id);
        $facilities = \App\Models\Facility::orderBy('id')->pluck('name','id')->toArray();
      
        return view('workgroups.information', ['title' => 'Workgroup Infromation', 'item' => $item, 'facilities' =>$facilities]);
    }
    
    
}
