<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
{
    
    public function index()
    {
        $field = Field::all();
        return view('admin.field.index',compact('field'));  
    }
    
    public function create()
    {   
        return view('admin.field.add');
    }
     
    public function store(Request $request)
    {
            $data = $request->except(['_token']);
            
            // dd($data);
             if(Field::create($data)){ 
                    
                 return redirect()->route('field')->with('success','Advisory Field Added!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }
   
    public function edit($id)
    {
        $field = Field::find($id);
        
         return view('admin.field.edit',compact('field'));
    }
    public function update(Request $request, $id)
    {   
        
            $data = $request->except(['_token','_method']);
             
             if(Field::whereId($id)->update($data)){ 
                 return redirect()->route('field')->with('update','Advisory Field Updated!');
                }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
    }

    public function delete($id)
    {   
        
       $ids = Field::where('id',$id)->first();
        
        if ($ids != null) {
            $data =  $ids->delete();
            return redirect()->route('field')->with('error','Advisory Field Deleted!');
        }
    }
	
}
