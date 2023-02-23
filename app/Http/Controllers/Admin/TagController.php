<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    
    public function index()
    {
        $tag = Tag::all();
        return view('admin.tag.index',compact('tag'));  
    }
    
    public function create()
    {   
        return view('admin.tag.add');
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token','image']);
            
            if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/tags'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            // dd($data);
             if(Tag::create($data)){ 
                    
                 return redirect()->route('tag')->with('success','Tag Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $tag = Tag::find($id);
        
         return view('admin.tag.edit',compact('tag'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method','image']);
             
             
             if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/tags'), $imageName);
                $data['image'] = $imageName;
               
            }
             
             if(Tag::whereId($id)->update($data)){ 
                 return redirect()->route('tag')->with('update','Tag Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = Tag::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('tag')->with('error','Tag Deleted!');
        }
    }
	
}
