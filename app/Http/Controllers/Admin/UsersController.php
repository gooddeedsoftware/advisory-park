<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));  
    }
    
    public function create()
    {   
        return view('admin.users.add');
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token','image']);
            
            if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/users'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            $data['type'] = 'user';
             if(User::create($data)){ 
                    
                 return redirect()->route('users')->with('success','User Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $users = User::find($id);
        
         return view('admin.users.edit',compact('users'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method','image']);
             
             
             if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/users'), $imageName);
                $data['image'] = $imageName;
               
            }
             
             if(User::whereId($id)->update($data)){ 
                 return redirect()->route('users')->with('update','User Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = User::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('users')->with('error','User Deleted!');
        }
    }
	
}
