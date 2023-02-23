<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Requirement,
        Post,Save,Following,Follower,Field,AdvisoryListing,AdvisoryRequest,BusinessProfile,
        Payment,Complain,Paytm,AdvisorPayment};
use Auth;
use Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function profile(Request $request)  /*Profile*/
    {   
        
        if(Auth::check()){
            
            $posts                =   Post::where('created_by',Auth::user()->id)->orderby('id','desc')->get();
            
            $following            =   Following::where('auth_id',Auth::user()->id)->where('status',1)->count();
         
            $follower             =   Follower::where('auth_id',Auth::user()->id)->where('status',1)->count();
         
            $advisory_listings    =   AdvisoryListing::where('added_by',Auth::user()->id)->orderby('id','desc')->get();
            
            $business_profile     =   BusinessProfile::where('user_id',Auth::user()->id)->orderby('id','desc')->get();
            
            $advisory_request     =   AdvisoryRequest::with('users','types')->where('advisor_id',Auth::user()->id)->latest()->get();
        
            $request_sent         =   AdvisoryRequest::with('types','advisors')->where('user_id',Auth::user()->id)->orderby('created_at','desc')->get();
           
            $saved_post           =   Save::with('posts','users')->where('blog_type','post')->where('user_id',Auth::user()->id)->where('status','1')->latest()->get();
        
            $requirements         =   Requirement::with('users')->where('created_by',Auth::user()->id)->latest()->get();
            
            $config['field']      =   Field::where('status','1')->get();
            /*$config['categories'] =   Category::where('status','1')->get();       
            $config['skills']     =   Skill::where('status','1')->get();
            $config['tags']       =   Tag::where('status','1')->get();*/
            
            $completed_adv_req    =   AdvisoryRequest::where('advisor_id',Auth::user()->id)->where('status','6')->count();
            $rejected_adv_req     =   AdvisoryRequest::where('advisor_id',Auth::user()->id)->where('status','3')->count();
    
            $adv_payment          =   new AdvisorPayment();
        
            if(isset($request->start_date) && !empty($request->start_date) && isset($request->end_date) && !empty($request->end_date))
            {
               $adv_payment       =   $adv_payment->whereBetween('advisor_payments.transaction_date', [$request->start_date." 00:00:00", $request->end_date." 23:59:59"]);
            }
            
            $adv_payment          =   $adv_payment->where('advisor_id',Auth::user()->id)->latest()->get();

            $complains            =   Complain::with('lead','users')->where('created_by',Auth::user()->id)->latest()->get();
            
            $advReport            =   AdvisoryRequest::with('users','types')->latest()->where('advisor_id',Auth::user()->id)->where('status','5')->get();
            
            // $advReport            =   Paytm::where('advisor_id',Auth::user()->id)->latest()->get();
            
            $advSum               =   Paytm::where('advisor_id',Auth::user()->id)->where('status','TXN_SUCCESS')->sum('amount');
            
		   
		    return view('profile',compact('config','posts','following','follower','advisory_listings','business_profile','advisory_request','request_sent','saved_post','requirements','completed_adv_req','rejected_adv_req','adv_payment','complains','advReport','advSum'));
        
            
        }else{
            return redirect()->route('index');
        }
         
       
    }
    
    public function userProfile($id)  /*Profile*/
    {   
        if(Auth::check()){
            $config['field']        =   Field::where('status','1')->get();
            /*$config['categories'] =   Category::where('status','1')->get();       
            $config['skills']     =   Skill::where('status','1')->get();
            $config['tags']       =   Tag::where('status','1')->get();*/
            
            $posts      =   Post::where('created_by',$id)->latest()->get();
            
            $following  =   Following::where('auth_id',$id)->where('status',1)->count();
             
            $follower   =   Follower::where('auth_id',$id)->where('status',1)->count();
            
            $user = User::find($id);
            
            return view('user-profile',compact('user','following','follower','posts','config'));
        }else{
            return view('login');
        }
        
    }
    
    public function profileUpdate(Request $request)  /*Profile*/
    {   
        $data = $request->except(['_token']);
        
        // dd($data);
        
        if($request->ajax()){
            
            $data = $request->except(['_token']);

            /* check if skill is new*/
            if(isset($request->skills)){
                $new_skills = addNewSkill($request->skills);
                if(!empty($new_skills)){
                    $request->skills = $new_skills;
                }

                $data['skills']  = implode(',',$request->skills);
            }

            /* check if tag is new */
            
            if($request->file('image')){
                  
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('front/images/users'), $imageName);
                $data['image'] = $imageName;
               
            }
            
            if($request->file('cover_image')){
                  
                $imageName = $request->cover_image->getClientOriginalName();
                $request->cover_image->move(public_path('front/images/users'), $imageName);
                $data['cover_image'] = $imageName;
               
            }
            
            // dd($data);
            
            if(User::whereId($request->id)->update($data)){
                return response()->json(['status'=>true,'message'=>'Profile Updated!']);
            }
        }
        
        User::whereId($request->id)->update($data);
        return redirect()->back()->with('success','Profile Updated!');
    }
    
    public function autocomplete(Request $request) /*Profile*/
    {   
        if(Auth::check()){
            $data = AdvisoryListing::select("listing_name as value", "id")
                    ->where('listing_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->where('added_by','!=',Auth::user()->id)
                    ->get();
        }else{
            $data = AdvisoryListing::select("listing_name as value", "id")
                    ->where('listing_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        }
        
            return response()->json($data);
    }
    
    public function autocompleteRequirement(Request $request) /*Profile*/
    {   
        if(Auth::check()){
            $data = Requirement::select("title as value", "id")
                    ->where('title', 'LIKE', '%'. $request->get('search'). '%')
                    ->where('created_by','!=',Auth::user()->id)
                    ->get();
        }else{
            $data = Requirement::select("title as value", "id")
                    ->where('title', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
        }
        
            return response()->json($data);
    }
    
    public function changeStatus(Request $request) /*Profile*/
    {   
        $data = $request->except('_token');
        
        if($data){
            
            $message = "";
            if($request->status == '2'){
                 AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status,'fees'=>$request->fees,'advisors_message'=>$request->message]);
                 $message = 'Advisory Request Accepted!';
            }
            elseif($request->status == '3'){
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status,'reason_for_reject'=>$request->reason]);
                 $message = 'Advisory Request Rejected!';
            }
            elseif($request->status == '4'){
                // dd($request);
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status]);
                
                $advisory_request = AdvisoryRequest::whereId($request->id)->first();
                    
                if($advisory_request->fees){
                    // dd($request);
                    $portal_charge = portalCharge($advisory_request->fees);
                                    
                    $final_amount = (float)$advisory_request->fees - (float)$portal_charge;
                    // $final_amount = (float)$advisory_request->fees;
                   
                    $payment = Payment::create([
                        'advisory_id'       =>      $request->id,
                        'advisory_url'      =>      $request->advisory_url,
                        'advisory_type'     =>      $request->advisory_type,
                        'from_user'         =>      $advisory_request->user_id,
                        'to_user'           =>      $advisory_request->advisor_id,
                        'amount'            =>      $advisory_request->fees ?? 0,
                        'portal_charge'     =>      $portal_charge ?? 0,
                        'final_amount'      =>      $final_amount ?? 0,
                        'cr_dr'             =>      '-',
                        'method'            =>      'Cash',
                        'payment_type'      =>      'User Payment',
                        'status'            =>      'In-Process'
                    ]);
                    
                  /*  $admin = User::whereType('admin')->first();  
                    PaymentRequest::create([
                                            'payment_id' => $payment->id,
                                            'admin_id' => $admin->id,
                                            'advisor_id' => $advisory_request->advisor_id,
                                            'amount' => $final_amount,
                                            'status' => $final_amount,
                                        ]);
                                    */
                    $advisor = User::whereId($advisory_request->advisor_id)->first();  
                    $final_wallet = (float)$advisor->wallet + $final_amount;
                    $advisor->wallet = $final_wallet;    
                    $advisor->save();
            
                    $message = 'Advisory Payment Done!';
                }
                
            }
            elseif($request->status == '5'){
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status]);
                 $message = 'Advisory Completed!';
            }
            elseif($request->status == '6'){
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status]);
                 $message = 'Advisory Dismissed!';
            }
            elseif($request->status == '7'){
                 
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status,'rating'=>$request->rating,'feedback'=>$request->feedback]);
                 $message = 'Rating & Feedback Submitted!';
            }
            elseif($request->status == '8'){
                 
                $adv  =  AdvisoryRequest::find($request->id);
    
                AdvisoryRequest::create([    
                        "title" => $adv->title,
                        "subject" => $adv->subject,
                        "type" => $adv->type,
                        "category" => $adv->category,
                        "advisor_id" => $adv->advisor_id,
                        "user_id" => $adv->user_id,
                        "listing_id" => $adv->listing_id,
                        "listing_name" => $adv->listing_name,
                        "lead_source" => 'Re-request',
                        "lead_expire_date" => $adv->lead_expire_date,
                        "state_name" => $adv->state_name,
                        "city_name" => $adv->city_name,
                        "image" => $adv->image,
                        "description" => $adv->description,
                        "status" => "1",
                        "req_type" => $adv->req_type,
                        "satisfied" => $adv->satisfied,
                        "comment" => $adv->comment,
                        "comm" => $adv->comm,
                        "fees" => $adv->fees,
                        "query_box" => $adv->query_box,
                        "rating" => null,
                        "reason_for_reject" => null,
                        "feedback" => null,
                    ]);
            
                AdvisoryRequest::whereId($request->id)->update(['status'=>$request->status]);
                 $message = 'Request Re-sent Successfully!';
            }
            
            return response()->json(['status'=>true,'message'=>$message]);
            
        }else{
             return response()->json(['status'=>false,'message'=>'Something went wrong!']);
        }
    }
    
    public function complain(Request $request)
    {   
        // dd($request);
        $data = $request->except('_token');
        if($data){
                
                $data['created_by'] = Auth::user()->id;
                
                Complain::create($data);
            
                return redirect()->back()->with(['status'=>true,'message'=>'Complain Submitted Successfully!']);
            }else{
                return redirect()->back()->with(['status'=>false,'message'=>'Something went wrong!']);
            }
    }
    
    public function businessProfileCreate(Request $request)  /*Business Profile*/
    {   
       
        $data = $request->except(['_token','id']); 

        $images=array();
            if($files=$request->file('org_images')){
                foreach($files as $file){
                    $imageName = $file->getClientOriginalName();
                    $file->move(public_path('front/images/business_profile'),$imageName);
                    $images[] = $imageName;
                }
                $data['org_images'] = implode(',',$images);
            }
           
        $data['user_id'] = Auth::user()->id;
        $data['nature_of_business'] = $request->nature_of_business ? json_encode($request->nature_of_business) : null;
        

        // dd($data);
	    if($data){
            BusinessProfile::create($data);
            
            return response()->json(['status'=>true,'message'=>'Business Profile Added!']);
        }else{
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);
        }
    }
    
     public function businessProfileEdit($id)  /*Business Profile*/
    {
        $data = BusinessProfile::find($id);
        return response()->json($data);
    }
    
    public function businessProfileUpdate(Request $request) /*Business Profile*/
    {   
       
        $data = $request->except(['_token','method']); 
        
        $images=array();
            if($files=$request->file('org_images')){
                foreach($files as $file){
                    $imageName = $file->getClientOriginalName();
                    $file->move(public_path('front/images/business_profile'),$imageName);
                    $images[] = $imageName;
                }
                $data['org_images'] = implode(',',$images);
            }
           
        $data['nature_of_business'] = $request->nature_of_business ? json_encode($request->nature_of_business) : null;
        
        if($data){
            BusinessProfile::whereId($request->id)->update($data);
            
            return response()->json(['status'=>true,'message'=>'Business Profile Updated!']);
        }else{
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);
        }
    }
    
    public function businessProfileDelete($id)   /*Business Profile*/
    {   
        
        BusinessProfile::find($id)->delete();
      
        return response()->json(['status'=>false,'message'=>'Business Profile Deleted!']);
    }
    
    
    
   
}
