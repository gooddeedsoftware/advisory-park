<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index',compact('category'));  
    }
    
    public function create()
    {   
        return view('admin.category.add');
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token','image']);
            
            if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/categories'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            // dd($data);
             if(Category::create($data)){ 
                    
                 return redirect()->route('category')->with('success','Category Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $category = Category::find($id);
        
         return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method','image']);
             
             
             if($request->file('image')){
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('admin/images/categories'), $imageName);
                $data['image'] = $imageName;
               
            }
             
             if(Category::whereId($id)->update($data)){ 
                 return redirect()->route('category')->with('update','Category Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = Category::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('category')->with('error','Category Deleted!');
        }
    }
	
}
