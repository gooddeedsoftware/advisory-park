<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    
    public function index()
    {
        $skill = Skill::all();
        return view('admin.skill.index',compact('skill'));  
    }
    
    public function create()
    {   
        return view('admin.skill.add');
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token','image']);
            
            if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/skills'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            // dd($data);
             if(Skill::create($data)){ 
                    
                 return redirect()->route('skill')->with('success','Skill Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $skill = Skill::find($id);
        
         return view('admin.skill.edit',compact('skill'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method','image']);
             
             
             if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/skills'), $imageName);
                $data['image'] = $imageName;
               
            }
             
             if(Skill::whereId($id)->update($data)){ 
                 return redirect()->route('skill')->with('update','Skill Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = Skill::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('skill')->with('error','Skill Deleted!');
        }
    }
	
}
