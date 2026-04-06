<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegistrationNotification;

use Illuminate\Support\Str;

class users extends Controller
{
    public function users_management(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        
        if($request->input('id')!='')
        {
            $id=$request->input('id');
           
            
            if($id=='0')
            {
                $email=$request->input('email');
                $check=\App\Models\User::where('email', $email)->exists();
                if($check)
                {
                    $request->session()->flash('error', 'Email already associated to another account!');
                    return redirect('users-management');
                }

                $name=$request->input('name');
                $check=\App\Models\User::where('name', $name)->exists();
                if($check)
                {
                    $request->session()->flash('error', 'Username already taken!');
                    return redirect('users-management');
                }
                $item = new \App\Models\User();
                $item->created_at=NOW();
                $request->session()->flash('success', 'User created successfully!');
            }
            elseif($id!='0')
            {
                 
                $item= \App\Models\User::find($id);
                $item->updated_at=NOW();
                $request->session()->flash('success', 'User updated successfully!');
            }
            
        if ($request->input('user_level') == 'admin') {
            $validate['facility_id'] = 'required';
        }

        
        $facility = \App\Models\Facility::find($request->input('facility_id'));


            
        $item->name = $item->sync_user = $request->input('name');   
        $item->fullname = $request->input('fullname');
        $item->email = $request->input('email');
            
        if ($request->input('password') != '') {
            $item->password = Hash::make($request->input('password'));
        }
            
        $item->facility_id = $request->input('facility_id');
        $item->facility_name = $facility->name;
        $item->timezone = $facility->timezone;
            
        $item->sync_password_raw = str::random(8);
        $item->sync_password = md5($item->sync_password_raw);
        $item->activation_code = Str::random(30).time();
        $item->enabled = $request->input('enabled') ? 1 : 0;
        $item->status = 1;

        $item->save();

        $item->assignRole($request->input('user_level'));

        //$facility = auth()->user()->facility;
        //activity()->by($facility)->performedOn($item)->withProperties(['key'=>'new', 'user_id' => auth()->user()->id])->log('New user by : '. auth()->user()->name);

        // Send registeration email
        //$item->notify(new RegistrationNotification($item));
        $item->syncRoles([$request->input('user_level')]);
   
            return redirect('users-management');
        }
        return view('users.users_management', ['title'=> 'User Management']);
    }
    
     public function users_list(Request $request)
    {
         $user_id=$request->session()->get('id');
         $user=\App\Models\User::find($user_id);
         
        $items = \App\Models\User::whereNotIn('name', ['admin']);
        $facility_id = $user->facility_id ? $user->facility_id : '';
        $items->when($facility_id, function ($q) use ($facility_id) {
            return $q->where('facility_id', '=', $facility_id);
        });

        return Datatables::of($items)
            ->make(true);
        // if(auth()->user()->hasRole('admin')){
        //     $items = auth()->user()->facility->users()->whereNotIn('name', ['admin'])->latest()->get();  
        // } else {
        //     $items = User::whereNotIn('name', ['admin'])->latest()->get();
        // }
        // return Datatables::of($items)
        //         ->make(true);
    }

    public function update_user(Request $request)
    {
        $data=array();
        $data['success']=0;
        $id=$request->input('id');
        $column=$request->input('column');
        $value=$request->input('value');

        \App\Models\User::where('id', $id)->update([
            $column => $value
        ]);
        $data['success']=1;

        return response()->json($data);
    }
    
    public function user_form(Request $request)
    {
        $user_id=$request->session()->get('id');
        $user=\App\Models\User::find($user_id);
        $isSuper = $user->hasRole('super');
        
        
        $response=array();
        $response['success']=0;
        //$id=$request->input('id');
        $id=$request->input('id');
        $user1 = \App\Models\User::find($id);
        //$isSuper = $user->hasRole('super');
        
        $facility_id = $user->facility_id;
        $facilities = \App\Models\Facility::when(!$isSuper, function ($q) use($facility_id) {
            return $q->where('id', $facility_id);
        })
            ->orderBy('id')->pluck('name', 'id')->toArray();
        
        $userlevels = \App\Models\Role::when(!$isSuper, function($q) {
            return $q->where('name', '<>', 'super');
        })
        ->pluck('name', 'name')->toArray();

        if(!isset($user1->id))
        {
            $user1 = \App\Models\User::limit(1)->get();
            $user1->id=0;
            $user1->name='';
            $user1->password='';
            $user1->password_confirmation='';
            $user1->fullname='';
            $user1->email='';
            $user1->user_level='';
            $user1->facility_id=0;
            $user1->enabled=0;
        }
        
        
        $data = array(
            'facilities' => $facilities,
            'user2' => $user1,
            'userlevels' => $userlevels
        );
        
        $response['success']=1;
        $response['content']= view('users.user_form')->with($data)->render();
        
        return response()->json($response);
    }
    
    public function delete(Request $request)
    {
        $data=array();
        $data['success']=0;
        $data['msg']='';
        
        $id=$request->input('id');
        $user = \App\Models\User::findOrFail($id);
        $user->forceDelete();
        
        $data['msg']='User deleted successfully!';
        $data['success']=1;

        return response()->json($data);
        
    }
}
