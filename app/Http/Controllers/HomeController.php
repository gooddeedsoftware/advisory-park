<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Field,Requirement,Post,
            Like,Comment,Save,Following,Follower,AdvisoryRequest,
            BusinessProfile,Notification,RequirementInterest,PostInterest,
            Payment,AdvisoryListing};
use Auth;
use Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request) /*Home*/
    {   
       
        $config['field']        =   Field::where('status','1')->get();       
        /*$config['categories']   =   Category::where('status','1')->get();       
        $config['skills']       =   Skill::where('status','1')->get();
        $config['tags']         =   Tag::where('status','1')->get();*/
    
        if(Auth::check()){
            // $posts           =   Post::with('users','comments')->where('created_by','!=',Auth::user()->id)->latest()->get();
            $posts              =   Post::with('users','comments')->latest()->paginate(5);
            if ($request->ajax()) {
                $view = view('post-data',compact('posts'))->render();
                return response()->json(['html'=>$view]);
            }
            $business_profile   =   BusinessProfile::latest()->limit(5)->get();
            $listings           =   AdvisoryListing::where('id','!=',Auth::user()->id)->limit(5)->latest()->get();
            $requirements       =   Requirement::where('id','!=',Auth::user()->id)->limit(5)->latest()->get();
        }else{
            $posts              =   Post::with('users','comments')->latest()->paginate(5);
            if ($request->ajax()) {
                $view = view('post-data',compact('posts'))->render();
                return response()->json(['html'=>$view]);
            }
            $business_profile   =   BusinessProfile::latest()->limit(5)->get();
            $listings           =   AdvisoryListing::limit(5)->latest()->get();
            $requirements       =   Requirement::limit(5)->latest()->get();
        }
		return view('index',compact('config','posts','listings','requirements','business_profile'));
       
    }
    
    public function allAdvisors()  /*Home*/
    {
        $config['field']        =   Field::where('status','1')->get();   
        /*$config['categories'] =   Category::where('status','1')->get();       
        $config['skills']     =   Skill::where('status','1')->get();
        $config['tags']       =   Tag::where('status','1')->get();*/
        
            if(Auth::check()){ 
                $all_advisors  = BusinessProfile::with('users')->where('user_id','!=',Auth::user()->id)->orderby('id','desc')->distinct('user_id')->get();
            
                // dd($all_advisors);
            }else{
                return redirect()->route('login');
                $all_advisors  = BusinessProfile::with('users')->orderBy('business_profile.id','desc')->groupBy('business_profile.user_id')->get();
            }
        
		return view('advisors',compact('config','all_advisors'));
       
    }
    
    public function categories()
    {   
        $config['field']        =   Field::where('status','1')->get(); 
        $categories = Field::whereStatus('1')->get();
        
        return view('categories',compact('categories','config'));
    }
    
    public function getState(Request $request) /*Home*/
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name","id"]);
        return response()->json($data);
    }
    
    public function getCity(Request $request)  /*Home*/
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name","id"]);
        return response()->json($data);
    }
    
    public function accountSetting()   /*Home*/
    {   
         $advisory_request      =   AdvisoryRequest::with('users')->where('user_id',Auth::user()->id)->where('status','pending')->orderby('id','desc')->get();
         $config['field']        =   Field::where('status','1')->get();
         /*$config['categories']  =   Category::where('status','1')->get();       
         $config['skills']      =   Skill::where('status','1')->get();
         $config['tags']        =   Tag::where('status','1')->get();*/
         
         $notifications         =   Notification::where('entity_id',Auth::user()->id)->where('entity_type',session()->get('type'))->latest()->get();
		 return view('account-setting',compact('advisory_request','config','notifications'));
       
    }
    
    public function messages()  /*Home*/
    {   
		return view('messages');
       
    }
    
    public function updateNotification(Request $request)  /*Home*/
    {   
     
        if($notification = Notification::find($request->notification_id)){  
            $notification->update(['seen_status'=>1]);
        }

        if(in_array($request->type, ['requirement', 'post'])){
            
            $data = [
                'entity_id'=>Auth::user()->id, 
                'status'=>$request->status 
            ];
            $entity_id ='';
            $entity_type ='user';
            if($request->status !== null && $request->type == 'requirement')
            {
                
                $entity_id = Requirement::select('created_by')->where('id', $notification->activity_id)->first()->created_by;
                
                $data['requirement_id'] = $notification->activity_id;
                
                RequirementInterest::upsert($data, ['requirement_id', 'entity_id'], ['status']);
                
            } else if($request->status !== null && $request->type == 'post')
            {
                
                $entity_id = Post::select('created_by')->where('id', $notification->activity_id)->first()->created_by;
                
                $data['post_id'] = $notification->activity_id;
                
                PostInterest::upsert($data, ['post_id', 'entity_id'], ['status']);
                
            }

            if($request->status == 1){
                
                $msg = Auth::user()->name." Interested in your ".$request->type.".";
            }else{
                
                $msg = Auth::user()->name." Not Interested in your ".$request->type.".";
            }

            Notification::create([
                'notification'=>$msg,
                'link'=>$request->link,
                'entity_id'=>$entity_id, 
                'entity_type'=>$entity_type, 
                'activity_id'=>$notification->activity_id,
                'activity_type'=>Notification::activity_general,
                ]);
        }
      
        return response()->json(['status'=>true, "message"=>"Status Updated Succesful"]);        
    } 
    
    public function interestedOrNot(Request $request)  /*Home*/
    {   
      
        if(in_array($request->type, ['requirement', 'post'])){
            
            $data = [
                'entity_id'=>Auth::user()->id, 
                'status'=>$request->status 
            ];
            
            $entity_id ='';
            $entity_type ='user';
            
            if($request->status !== null && $request->type == 'requirement'){
                
                $data['requirement_id'] = $request->activity_id;
                $entity_id = Requirement::select('created_by')->where('id', $request->activity_id)->first()->created_by;
                RequirementInterest::upsert($data, ['requirement_id', 'entity_id'], ['status']);
                
            } else if($request->status !== null && $request->type == 'post'){
                
                $entity_id = Post::select('created_by')->where('id', $request->activity_id)->first()->created_by;
                $data['post_id'] = $request->activity_id;
                PostInterest::upsert($data, ['post_id', 'entity_id'], ['status']);
            }

            if($request->status == 1){  /* 1 for Interested  2 for Not Interested */
                $msg = ucfirst(Auth::user()->name)." interested in your ".$request->type.".";
            }else{
                $msg = ucfirst(Auth::user()->name)." not interested in your ".$request->type.".";
            }

            Notification::create([
                'notification'=>$msg,
                'link'=>$request->link,
                'entity_id'=>$entity_id, 
                'entity_type'=>$entity_type, 
                'activity_id'=>$request->activity_id,
                'activity_type'=>Notification::activity_general,
                ]);
        }
      
        return response()->json(['status'=>true, "message"=>"Status Updated Succesful"]);        
    }
    
    public function like(Request $request)  /*Home*/
    {   
        $exists =  Like::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->exists();
                
        if($exists == false){
            
                $like = new Like;
                $like->user_id = $request->user_id;
                $like->blog_type = $request->blog_type;
                $like->blog_id = $request->blog_id;
                $like->status = 1;
                
                $like->save();
                
                return redirect()->back()->with('success','Liked!');
        }
        else{
           
            if(Like::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->where('status',1)
                ->exists() == true){
                   
                    Like::where('user_id',$request->user_id)
                        ->where('blog_type',$request->blog_type)
                        ->where('blog_id',$request->blog_id)
                        ->where('status',1)
                        ->update(['status'=>0]);
                        
                return redirect()->back()->with('error','Disliked');
            }
            elseif(Like::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->where('status',0)
                ->exists() == true){
                    
                    Like::where('user_id',$request->user_id)
                        ->where('blog_type',$request->blog_type)
                        ->where('blog_id',$request->blog_id)
                        ->where('status',0)
                        ->update(['status'=>1]);
                        
                     return redirect()->back()->with('success','Liked');
            } else{
               
                return redirect()->back();
            }
        }
        
    }
    
    public function comment(Request $request) /*Home*/
    {
        if(Auth::check())
        {
            $user = User::find($request->user_id);
                
            $comment = new Comment;
            $comment->user_id = $request->user_id;
            $comment->blog_type = $request->blog_type;
            $comment->blog_id = $request->blog_id;
            $comment->user_name = $user->name;
            $comment->comment = $request->comment;
            
            $comment->save();
            
            return redirect()->back()->with('success','Commented!');
        }else{
            return redirect()->route('login')->with('error','Login First!');
        }
    }
    
    public function save(Request $request)  /*Home*/
    {   
        $exists =  Save::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->exists();
                
        if($exists == false){
            
                $save = new Save;
                $save->user_id = $request->user_id;
                $save->blog_type = $request->blog_type;
                $save->blog_id = $request->blog_id;
                $save->status = 1;
                
                $save->save();
                
                return redirect()->back()->with('success','Saved!');
        }
        else{
           
            if(Save::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->where('status',1)
                ->exists() == true){
                   
                    Save::where('user_id',$request->user_id)
                        ->where('blog_type',$request->blog_type)
                        ->where('blog_id',$request->blog_id)
                        ->where('status',1)
                        ->update(['status'=>0]);
                        
                return redirect()->back()->with('error','Unsaved');
            }
            elseif(Save::where('user_id',$request->user_id)
                ->where('blog_type',$request->blog_type)
                ->where('blog_id',$request->blog_id)
                ->where('status',0)
                ->exists() == true){
                    
                    Save::where('user_id',$request->user_id)
                        ->where('blog_type',$request->blog_type)
                        ->where('blog_id',$request->blog_id)
                        ->where('status',0)
                        ->update(['status'=>1]);
                        
                     return redirect()->back()->with('success','Saved');
            } else{
               
                return redirect()->back();
            }
        }
        
    }
    
    public function following(Request $request)  /*Home*/
    {   
        $exists =  Following::where('auth_id',$request->auth_id)
                   ->where('user_id',$request->user_id)
                   ->exists();
                
        if($exists == false){
            
                $following = new Following;
                $following->auth_id = $request->auth_id;
                $following->user_id = $request->user_id;
                $following->status  = 1;
                
                $following->save();
                
                $follower = new Follower;
                $follower->auth_id = $request->user_id;
                $follower->user_id = $request->auth_id;
                $follower->status  = 0;
                
                $follower->save();
                
                return redirect()->back()->with('success1','Followed!');
        }
        else{
           
            if(Following::where('auth_id',$request->auth_id)
                   ->where('user_id',$request->user_id)
                   ->where('status',1)
                   ->exists() == true){
                   
                    Following::where('auth_id',$request->auth_id)
                                ->where('user_id',$request->user_id)
                                ->where('status',1)
                                ->update(['status'=>0]);
                    
                    Follower::where('auth_id',$request->user_id)
                                ->where('user_id',$request->auth_id)
                                ->where('status',1)
                                ->update(['status'=>0]);
                        
                return redirect()->back()->with('error1','Unfollowed!');
            }
            elseif(Following::where('auth_id',$request->auth_id)
                    ->where('user_id',$request->user_id)
                    ->where('status',0)
                    ->exists() == true){
                    
                    Following::where('auth_id',$request->auth_id)
                                ->where('user_id',$request->user_id)
                                ->where('status',0)
                                ->update(['status'=>1]);
                    
                    Follower::where('auth_id',$request->user_id)
                                ->where('user_id',$request->auth_id)
                                ->where('status',0)
                                ->update(['status'=>1]);    
                    
                     return redirect()->back()->with('success1','Followed!');
            } else{
               
                return redirect()->back();
            }
        }
        
    }  
    
    public function CheckStatus()  /*Home*/
    {   
        $data = User::where('session_expire','<=',date('Y-m-d h:i:s'))->pluck('id'); 
        /*where('session_expire','=<',date('Y-m-d'))->*/
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function paymentRequest(Request $request) /*Home*/
    {
        // dd($request);
        $data = $request->except('_token');
        
        if(Auth::check()){
            if(Auth::user()->wallet >= $request->amount){
                $data['advisor_id'] = Auth::user()->id;
            
                $admin = User::whereType('admin')->first('id');
            
                Payment::create([
                                'from_user'     => Auth::user()->id,
                                'to_user'       => $admin->id ?? 1,
                                'amount'        => $request->amount,
                                'final_amount'  => $request->amount,
                                'cr_dr'         => '-',
                                'method'        => 'Cash', 
                                'payment_type'  => 'Payment Request', 
                                'status'        => 'In-Process'
                                ]);
                
                return redirect()->back()->with('success','Payment Requested Successful !');
            }else{
                return redirect()->back()->with('error','Insufficient Wallet!');
            }
            
        }else{
            return redirect()->back()->with('error','Login First!');
        }
    }
    
    

}
