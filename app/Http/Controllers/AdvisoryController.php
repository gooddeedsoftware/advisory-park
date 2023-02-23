<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Requirement,Post,Field,AdvisoryListing,AdvisoryRequest,Payment};
use Auth;
use Validator;
use Illuminate\Support\Str;

class AdvisoryController extends Controller
{
    
     public function advisory(Request $request) /*Advisory*/
    {   
        // dd($request);
        $config['field']        =   Field::where('status','1')->get();
       /* $config['categories'] =   Category::where('status','1')->get();       
        $config['skills']     =   Skill::where('status','1')->get();
        $config['tags']       =   Tag::where('status','1')->get();*/
        
        if($request->search){
            $search = $request->search;
            if(Auth::check()){ 
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where(function($query) use($search){
                                        $query->where('listing_name', 'like', '%' . $search . '%')
                                              ->orWhere('fees', 'like', '%' . $search . '%')
                                              ->orWhere('about_listing', 'like', '%' . $search . '%')
                                              ->orWhere('experience', 'like', '%' . $search . '%')
                                              ->orWhere('mode', 'like', '%' . $search . '%');
                                         })
                                        ->where('added_by','!=',Auth::user()->id)->get();
            }else{
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where(function($query){
                                        $query->where('listing_name', 'like', '%' . $search . '%')
                                              ->orWhere('fees', 'like', '%' . $search . '%')
                                              ->orWhere('about_listing', 'like', '%' . $search . '%')
                                              ->orWhere('experience', 'like', '%' . $search . '%')
                                              ->orWhere('mode', 'like', '%' . $search . '%');
                                         })
                                        ->get();
            }
        }
        elseif($request->mode){
            if(Auth::check()){
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where('mode', 'LIKE', '%'. $request->get('mode'). '%')->where('added_by','!=',Auth::user()->id)->get();
            }else{
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where('mode', 'LIKE', '%'. $request->get('mode'). '%')->get();
            }
        }

        elseif($request->from && $request->to){
            if(Auth::check()){ 
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::whereBetween('fees', [(int)$request->from, (int)$request->to])->where('added_by','!=',Auth::user()->id)->get();
            }else{
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::whereBetween('fees', [(int)$request->from, (int)$request->to])->get();
            }
        }
        else{
           
            if(Auth::check()){    
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::orderby('id','desc')->where('added_by','!=',Auth::user()->id)->get();
            }else{      
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::orderby('id','desc')->get();
            }
        }
       
		return view('advisory',compact('config','advisory_listings','field'));

    }
    
    public function fieldWiseAdvisory(Request $request)
    {   
        $config['field']        =   Field::where('status','1')->get();
        /*$config['categories'] =   Category::where('status','1')->get();       
        $config['skills']     =   Skill::where('status','1')->get();
        $config['tags']       =   Tag::where('status','1')->get();*/
        if(isset($request->field)){
            if(Auth::check()){
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where('category', $request->get('field'))->where('added_by','!=',Auth::user()->id)->get();
            }else{
                $field             = Field::whereStatus(1)->get();
                $advisory_listings = AdvisoryListing::where('category', $request->get('field'))->get();
            }
        }else{
            $field             = Field::whereStatus(1)->get();
            $advisory_listings = AdvisoryListing::latest()->get();
        }
        return view('field-wise-advisory',compact('config','advisory_listings','field'));
    }
    
    public function advisoryDetail($slug) 
    {   
        $config['field']        =   Field::where('status','1')->get();
        /*$config['categories'] =   Category::where('status','1')->get();       
        $config['skills']     =   Skill::where('status','1')->get();
        $config['tags']       =   Tag::where('status','1')->get();*/
        $data = AdvisoryListing::whereSlug($slug)->first();
        return view('advisory-details',compact('config','data'));
    }

    public function SendAdvisoryRequest(Request $request) /*Advisory Request*/
    {
        $data = $request->except('_token');
        
        $data['lead_expire'] = $request->lead_expire_date." ".$request->lead_expire_time;
        // dd($data);
        
        if($request->ajax()){
            if($data){
                
                AdvisoryRequest::create($data);
            
                return response()->json(['status'=>true,'message'=>'Request Sent Successfully!']);
            }else{
                return response()->json(['status'=>false,'message'=>'Something went wrong!']);
            }
        }
        else
        {
            if($data) 
            {
                // dd($data);
                if(AdvisoryRequest::where('user_id',$request->user_id)->where('advisor_id',$request->advisor_id)->where('listing_name',$request->listing_name)->where('listing_id',$request->listing_id)->first()){
                // if(AdvisoryRequest::where('user_id',$request->user_id)->where('advisor_id',$request->advisor_id)->where('listing_name',$request->listing_name)->where('listing_id',$request->listing_id)->where('status','4')->first()){
                    
                    return redirect()->back()->with(['error'=>'Already Requested!']);
                    
                }else{
                    /*$data['status'] = 4;
                    //   dd($request);
                    if($request->fees){
                        $portal_charge = portalCharge($request->fees);
                                        
                        $final_amount = (float)$request->fees - (float)$portal_charge;
                        // $final_amount = (float)$request->fees;
                       
                        Payment::create([
                                    'advisory_id'       =>      $request->listing_id,
                                    'advisory_url'      =>      $request->lead_url,
                                    'advisory_type'     =>      $request->lead_type,
                                    'from_user'         =>      $request->user_id,
                                    'to_user'           =>      $request->advisor_id,
                                    'amount'            =>      $request->fees ?? 0,
                                    'portal_charge'     =>      $portal_charge ?? 0,
                                    'final_amount'      =>      $final_amount ?? 0,
                                    'cr_dr'             =>      '-',
                                    'method'            =>      'Cash',
                                    'payment_type'      =>      'User Payment',
                                    'status'            =>      'In-Process'
                                ]);
                                        
                        // $admin = User::whereType('admin')->first();  
                        $advisor = User::whereId($request->advisor_id)->first();  
                        $final_wallet = (float)$advisor->wallet + $final_amount;
                        $advisor->wallet = $final_wallet;    
                        $advisor->save();  
                
                        AdvisoryRequest::create($data);
                
                        return redirect()->back()->with(['success'=>'Advisory Payment Done Successfully!']);
                    }*/
                                
                }
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong!']);
            }
        }
        
    }

    public function SendAdvisoryReRequest(Request $request) /*Advisory Re-Request */
    {
        $data = $request->except('_token');
        
        // dd($data);
            if($data){
                
                AdvisoryRequest::create($data);
            
                return redirect()->back()->with(['status'=>true,'message'=>'Request Re-Sent Successfully!']);
            }else{
                return redirect()->back()->with(['status'=>false,'message'=>'Something went wrong!']);
            }
        }
   
    public function advisoryListingCreate(Request $request)  /*Advisory*/
    {   
       
        dd($request->all());
        $data = $request->except(['_token','id']); 
        
        if($request->file('image')){
                  
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('front/images/advisory_listing'), $imageName);
            $data['image'] = $imageName;
           
        }
        
             $last = AdvisoryListing::latest()->first('id');
             $last_id = (int)$last->id + 1;
             
        
            $data['slug']       = Str::slug($request->listing_name."-".$last_id);
            $data['added_by']   = Auth::user()->id;
            $data['mode']       = $request->mode ? json_encode($request->mode) : null;
            
	    if($data){
	        
            AdvisoryListing::create($data);
            
            return response()->json(['status'=>true,'message'=>'Advisory Listing Added!']);
        }else{
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);
        }
    }
    
     public function advisoryListingEdit($id)  /*Advisory*/
    {
        $data = AdvisoryListing::find($id);
        return response()->json($data);
    }
    
    public function advisoryListingUpdate(Request $request)  /*Advisory*/
    {   
      
        $data = $request->except(['_token','method']); 
        
        
        if($request->file('image')){
                  
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('front/images/advisory_listing'), $imageName);
            $data['image'] = $imageName;
           
        }
        $data['mode'] = $request->mode ? json_encode($request->mode) : null;
        
      
        if($data){
            AdvisoryListing::whereId($request->id)->update($data);
            
            return response()->json(['status'=>true,'message'=>'Advisory Listing Updated!']);
        }else{
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);
        }
    }
    
    
    public function advisoryListingDelete($id)  /*Advisory*/
    {   
        
        AdvisoryListing::find($id)->delete();
      
        return response()->json(['status'=>false,'message'=>'Advisory Listing Deleted!']);
    }
   
    
   
}
