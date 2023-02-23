<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Post,Field,PostInterest};
use Auth;
use Validator;
use Illuminate\Support\Str;
use Session;
class PostController extends Controller
{
    public function postStore(Request $request) /*Post*/
    {
    
        if(Session::get('type') == 'User'){
    
            return redirect()->back()->with('error','Only Advisors can create Post.You are not an Advisor!');
        }
        else
        {
        
    		$data = $request->except(['_token','id']); 
    	    
            $validator = Validator::make($request->all(), [
                'title'     => 'required', 
                'category'  => 'required', 
                'skill'     => 'required', 
                // 'tag'       => 'required', 
            ]);
          
            /* check if category is new*/
            $new_cat = addNewCategory($request->category);
            if(!empty($new_cat)){
                $request->category = $new_cat;
            }
            /* check if skill is new*/
            $new_skill = addNewSkill($request->skill);
            if(!empty($new_skill)){
                $request->skill = $new_skill;
            }
            /* check if tag is new */
            $new_tag = addNewTag($request->skill);
            if(!empty($new_tag)){
                $request->tag = $new_tag;
            }
        
        
            if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
            }
            else{
                
                if($request->file('image')){   
                    $imageName = time().'-'.$request->image->getClientOriginalName();
                    $request->image->move(public_path('front/images/posts'), $imageName);
                    $data['image'] = $imageName;
                }
                
                 $last = Post::latest()->first('id');
                 $last_id = (int)$last->id + 1;
                
                $data['category']   = isset($request->category) ? implode(',',$request->category) : null;
                $data['skill']      = isset($request->skill) ? implode(',',$request->skill) : null;
                $data['tag']        = isset($request->tag) ? implode(',',$request->tag) : null; 
                $data['slug']       = Str::slug($request->title."-".$last_id);
                $data['created_by'] = Auth::user()->id;
                
                Post::create($data);
            
                
                return redirect()->route('index')->withSuccess('New Post Updated!');
            }
        }
       
    }

    public function postEdit($id) /*Post*/
    {
        $post = Post::find($id);
        return response()->json($post);
    }
    
    public function postDetails($slug) /*Post*/
    {   
        $config['field']      =   Field::where('status','1')->get();       
        // $config['categories'] =   Category::where('status','1')->get();       
        // $config['skills']     =   Skill::where('status','1')->get();
        // $config['tags']       =   Tag::where('status','1')->get();
        
        $post = Post::with('users','comments')->where('slug',$slug)->first();
        $interest = null;
        if(Auth::check()){
            $interest = PostInterest::where('post_id',$post->id)->where('entity_id',Auth::user()->id)->first();
        }    
        $all_interested = PostInterest::with('posts','users')->where('post_id',$post->id)->where('status',1)->get();
        // dd($all_interested);
        
        return view('post-details',compact('post','config','interest','all_interested'));
    }

    public function postUpdate(Request $request) /*Post*/
    {   
        if(!$request->id){
            return redirect()->back()->withError('Something went wrong !');
        }

		$data = $request->except(['_token','id']); 
	    
        $validator = Validator::make($request->all(), [
            'title'     => 'required', 
            'category'  => 'required', 
            'skill'     => 'required', 
            // 'tag'       => 'required', 
        ]);

        /* check if category is new*/
        $new_cat = addNewCategory($request->category);
        if(!empty($new_cat)){
            $request->category = $new_cat;
        }
        /* check if skill is new*/
        $new_skill = addNewSkill($request->skill);
        if(!empty($new_skill)){
            $request->skill = $new_skill;
        }
        /* check if tag is new */
        $new_tag = addNewTag($request->tag);
        if(!empty($new_tag)){
            $request->tag = $new_tag;
        }
        
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }else{
            if($request->file('image')){   
                $imageName = time().'-'.$request->image->getClientOriginalName();
                $request->image->move(public_path('front/images/posts'), $imageName);
                $data['image'] = $imageName;
            }
            
            $data['category']   = implode(',',$request->category);
            $data['skill']      = implode(',',$request->skill);
            $data['tag']        = implode(',',$request->tag); 
            
            Post::find($request->id)->update($data);
            
            return redirect()->back()->withSuccess('Post Updated!');
        }
       
    }

    public function postDelete($id) /*Post*/
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'status' => true,
            'message' => "Post deleted Successfully"
        ]);
    }
    
}