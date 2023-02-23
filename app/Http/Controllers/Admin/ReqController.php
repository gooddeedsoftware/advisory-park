<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Requirement,Skill,Tag,Category,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReqController extends Controller
{
    
    public function index()
    {
        $requirements = Requirement::all();
        
        
        return view('admin.requirement.index',compact('requirements'));  
    }
    
    public function create()
    {   
         
        $categories = Category::all();
        $skills = Skill::all();
        $tags = Tag::all();
        
        $users = User::all();
        return view('admin.requirement.add',compact('categories','skills','tags','users'));
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token','image']);
            
            if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/requirements'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            // dd($data);
             if(Requirement::create($data)){ 
                    
                 return redirect()->route('req')->with('success','Requirement Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $requirement = Requirement::find($id);
        
        $categories = Category::all();
        $skills = Skill::all();
        $tags = Tag::all();
        
        $users = User::all();
        
         return view('admin.requirement.edit',compact('requirement','categories','skills','tags','users'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method','image']);
             
             
             if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/requirements'), $imageName);
                $data['image'] = $imageName;
               
            }
             
             if(Requirement::whereId($id)->update($data)){ 
                 return redirect()->route('req')->with('update','Requirement Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = Requirement::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('req')->with('error','Requirement Deleted!');
        }
    }
	
}
