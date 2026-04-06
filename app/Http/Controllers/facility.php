<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class facility extends Controller
{
    public function facility_information(Request $request, $id=0)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);

        if($id==0)
        $item = $user->facility;
        else $item=\App\Models\Facility::find($id);

        if($request->input('facility_update')!='')
        {
            $item = \App\Models\Facility::find($item->id);
            $old = $item->name;
            $item->name = $request->input('name');
            $item->location = $request->input('location');
            $item->description = $request->input('description');
            $item->timezone = $request->input('timezone');
            $item->save();

            $request->session()->flash('success', 'Facility information updated successfully!');
            if($id==0)
                return redirect('facility-info');
            else return redirect('facility-info/'.$id);
        }

        if($request->input('id')!='')
        {
            $id2=$request->input('id');
            if($id2=='0')
            {
                $item = new \App\Models\Workgroup();
                $item->created_at=NOW();
                $request->session()->flash('success', 'Workgroup created successfully!');
            }
            elseif($id2!='0')
            {
                $item = \App\Models\Workgroup::find($id2);
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

                if($id==0)
                return redirect('facility-info');
                else return redirect('facility-info/'.$id);
        }
        
        return view('facilities.facility_information', ['title'=>'Facility Information', 'item'=>$item]);
    }
    
    public function fetch_description(Request $request){
        $data=array();
        $data['success']=0;
        
        $data['content']="<option value=''>Please select</option>";
        
        $id=$request->input('id');
        
        $row=\App\Models\Facility::where('id', $id)->get();
        foreach($row as $r)
        {
            $data['content'].="<option value='".$r->id."'>".$r->description."</option>";
        }
       
        $data['success']=1;
        return response()->json($data);
    }
    
    public function fetch_location(Request $request){
        $data=array();
        $data['success']=0;
        
        $data['content']="<option value=''>Please select</option>";
        
        $id=$request->input('id');
        
        $row=\App\Models\Facility::where('id', $id)->get();
        foreach($row as $r)
        {
            $data['content'].="<option value='".$r->id."'>".$r->location."</option>";
        }
       
        $data['success']=1;
        return response()->json($data); 
    }
    
    public function fetch_timezone(Request $request){
        $data=array();
        $data['success']=0;
        $data['content']="<option value=''>Please select</option>";
        
        $id=$request->input('id');
        $row=\App\Models\Facility::where('id', $id)->get();
        foreach($row as $r)
        {
            $data['content'].="<option value='".$r->id."'>".$r->timezone."</option>";
        }
       
        $data['success']=1;
        return response()->json($data);
    }
    
    public function facilities_management(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        //add/edit facility
        if($request->input('id')!='')
        {
            $id=$request->input('id');
            if($id=='0')
            {
                $item = new \App\Models\Facility();
                $item->created_at=NOW();
                $request->session()->flash('success', 'Facility created successfully!');
            }
            elseif($id!='0')
            {
                $item = \App\Models\Facility::find($id);
                $item->updated_at=NOW();
                $request->session()->flash('success', 'Facility updated successfully!');
            }
            
            
            $item->name = $request->input('name');
            $item->location = $request->input('location');
            $item->description = $request->input('description');
            $item->timezone = $request->input('timezone');
            $item->user_id = $user->id;
        
            $item->save();

        /*$facility = auth()->user()->facility;
        activity()->by($facility)->performedOn($item)->withProperties(['key'=>'new', 'user_id' => auth()->user()->id])->log('New facility by : '. auth()->user()->name);*/

        
        //event(new TreeChanged($item->id));
        
        //return redirect('/facilities')->with('success', 'Facility Created');
        return redirect('facilities-management');
        }
        
        return view('facilities.facilities_management', ['title' =>'Facility Management']);
    }
    
    public function list_facilities(Request $request)
    {
        $items = \App\Models\Facility::query();        
        return Datatables::of($items)
                ->rawColumns(['link'])
                ->make(true);
    }
    
    public function form(Request $request)
    {
        $data=array();
        $id=$request->input('id');
        $item = \App\Models\Facility::find($id);
        
        if(!isset($item->id))
        {
            $item = \App\Models\Facility::limit(1)->get();
            $item->id=0;
            $item->name='';
            $item->description='';
            $item->location='';
            $item->timezone=0;
        }
        
        $data['success']=1;
        $data['content'] = view('facilities.facility_form')->with('item', $item)->render();
        
        return response()->json($data);
    }
    
    public function delete(Request $request)
    {
        $data=array();
        $data['success']=0;
        $data['msg']='';
        
        $id=$request->input('id');
        $item = \App\Models\Facility::find($id);
        if (($item->workstations->count()) > 0) {
            $data['msg']='Can not delete, because there are workstations belong to this facility!';
            return response()->json($data);
        }
        // log before delete
        // $facility = auth()->user()->facility;
        // activity()->by($facility)->performedOn($item)->withProperties(['key'=>'deleted', 'user_id' => auth()->user()->id])->log('Facility deleted by : '. auth()->user()->name);
        
        $item->delete();
        
        $data['msg']='Facility deleted successfully!';
        $data['success']=1;
        //event(new TreeChanged($id));
        
        return response()->json($data);
    }
}
