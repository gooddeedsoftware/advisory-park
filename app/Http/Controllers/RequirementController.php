<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Requirement,Field,RequirementInterest};
use Auth;
use Validator;
use Illuminate\Support\Str;
use Artisan;
class RequirementController extends Controller
{
    public function requirements(Request $request) /*Requirement*/
    {   
         $config['field']      =   Field::where('status','1')->get();
         
        if(isset($request->field)){
            if(Auth::check()){
                $field        = Field::whereStatus(1)->get();
                $requirements = Requirement::where('skill', $request->get('field'))->where('created_by','!=',Auth::user()->id)->get();
            }else{
                $field        = Field::whereStatus(1)->get();
                $requirements = Requirement::where('skill', $request->get('field'))->get();
            }
        }elseif(isset($request->search)){
                $search = $request->search;
            if(Auth::check()){ 
                $field        = Field::whereStatus(1)->get();
                
                
                $requirements = Requirement::where(function($query) use ($search){
                                      
                                        $query->where('title', 'like', '%' . $search . '%')
                                              ->orWhere('description', 'like', '%' . $search . '%')
                                              ->orWhere('skill', 'like', '%' . $search . '%');
                                         })
                                        ->where('created_by','!=',Auth::user()->id)->get();
            }else{
                $field        = Field::whereStatus(1)->get();
                $requirements = Requirement::where(function($query) use ($search){
                                        $query->where('title', 'like', '%' . $search . '%')
                                              ->orWhere('description', 'like', '%' . $search . '%')
                                              ->orWhere('skill', 'like', '%' . $search . '%');
                                         })
                                        ->get();
            }
        }else{
            if(Auth::check()){    
                $field        = Field::whereStatus(1)->get();
                $requirements = Requirement::latest()->where('created_by','!=',Auth::user()->id)->get();
            }else{      
                $field        = Field::whereStatus(1)->get();
                $requirements = Requirement::latest()->get();
            }
        }
        return view('requirements',compact('field','requirements','config'));
        
    }
    
    public function requirementStore(Request $request) /*Requirement*/
    {   
	    $data = $request->except(['_token','id']); 
	   // dd(gettype($data['skill']));
	   // dd($data);
	    
        $validator = Validator::make($request->all(), [
            'title'     => 'required', 
            // 'category'  => 'required', 
            // 'skill'     => 'required', 
            // 'tag'       => 'required', 
        ]);

          /* check if category is new*/
          if(isset($request->category))
            $new_cat = addNewCategory($request->category);
              if(!empty($new_cat)){
                  $request->category = $new_cat;
              }
              
          /* check if skill is new*/
                    /* check if skill is new*/
          if(isset($request->skill) && gettype($data['skill']) == 'array')
              $new_skill = addNewField($request->skill);
              if(!empty($new_skill)){
                  $request->skill = $new_skill;
              }
          /*
          
          
          /*if(isset($request->skill) && gettype($data['skill']) == 'array')
              $new_skill = addNewSkill($request->skill);
              if(!empty($new_skill)){
                  $request->skill = $new_skill;
              }*/
          /* check if tag is new */
          if(isset($request->tag))
              $new_tag = addNewTag($request->tag);
              if(!empty($new_tag)){
                  $request->tag = $new_tag;
              }
          
        
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }else{
            
            $last = Requirement::latest()->first('id');
            
            $last_id = (int)$last->id + 1;
           
            $data['category']   = $request->category ? implode(',',$request->category) : null;
            if(gettype($data['skill']) == 'string'){
                $data['skill']      = $request->skill ?? null;
            }else{
                $data['skill']      = $request->skill ? implode(',',$request->skill) : null;
            }
            $data['tag']        = $request->tag ? implode(',',$request->tag) : null;
            $data['slug']       = Str::slug($request->title."-".$last_id);
            
            $data['created_by'] = Auth::user()->id;
            
            Requirement::create($data);
            
            return redirect()->back()->withSuccess('New Requirement Added!');
        }
              
    }

    public function requirementDetails($slug) /*Requirement*/
    {   
        if(Auth::check()){
            
            $config['field']      =   Field::where('status','1')->get();       
         /*   $config['categories'] =   Category::where('status','1')->get();       
            $config['skills']     =   Skill::where('status','1')->get();
            $config['tags']       =   Tag::where('status','1')->get();
            */
            $requirement = Requirement::with('users','comments')->where('slug',$slug)->first();
            
            if(!empty($requirement)){
            
                $interest = RequirementInterest::where('requirement_id',$requirement->id)->where('entity_id',Auth::user()->id)->first();
                $all_interested = RequirementInterest::with('requirements','users')->where('requirement_id',$requirement->id)->where('status',1)->get();
                return view('requirement-details',compact('requirement','interest','config','all_interested'));
            }
            return redirect()->back()->with('error','Requirement Deleted Already!');
        
        }else{
            return view('login')->with('error','Login first!');
        }
    }

    public function requirementEdit($id) /*Requirement*/
    {
        $post = Requirement::find($id);
        return response()->json($post);
    }
    
    public function requirementUpdate(Request $request) /*Requirement*/
    {   
        if(!$request->id){
            return redirect()->back()->withError('Something went wrong !');
        }

		$data = $request->except(['_token','id']); 
	    
        $validator = Validator::make($request->all(), [
            'title'     => 'required', 
            // 'category'  => 'required', 
            // 'skill'     => 'required', 
            // 'tag'       => 'required', 
        ]);

        /* check if category is new*/
        if(isset($request->category))
            $new_cat = addNewCategory($request->category);
            if(!empty($new_cat)){
                $request->category = $new_cat;
            }
        /* check if skill is new*/
        if(isset($request->skill))
            $new_skill = addNewSkill($request->skill);
            if(!empty($new_skill)){
                $request->skill = $new_skill;
            }
        /* check if tag is new */
        if(isset($request->tag))
            $new_tag = addNewTag($request->tag);
            if(!empty($new_tag)){
                $request->tag = $new_tag;
            }
        
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }else{
            if($request->file('image')){   
                $imageName = time().'-'.$request->image->getClientOriginalName();
                $request->image->move(public_path('front/images/requirements'), $imageName);
                $data['image'] = $imageName;
            }
            
            $data['category']   = $request->category ? implode(',',$request->category) : null;
            if(gettype($data['skill']) == 'string'){
                $data['skill']      = $request->skill ?? null;
            }else{
                $data['skill']      = $request->skill ? implode(',',$request->skill) : null;
            }
            $data['tag']        = $request->tag ? implode(',',$request->tag) : null;
          
            
            Requirement::find($request->id)->update($data);
            
            return redirect()->back()->withSuccess('Requirement Updated!');
        }
       
    }

    public function requirementDelete($id) /*Requirement*/
    {
        
        Artisan::call('notification:delete_requirement', ['id' => $id]);
        
        $requirement = Requirement::find($id);
        $requirement->delete();
        
        return response()->json([
            'status' => true,
            'message' => "Requirement deleted Successfully!"
        ]);
    }
}