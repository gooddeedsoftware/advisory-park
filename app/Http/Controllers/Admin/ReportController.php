<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{AdvisoryListing,AdvisoryRequest,Payment,Paytm};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function advisoryReport(Request $request)
    {
        
        $advisory = new AdvisoryRequest();
        
        if(isset($request->start_date) && !empty($request->start_date) && isset($request->end_date) && !empty($request->end_date))
        {
            $advisory = $advisory->whereBetween('created_at', [$request->start_date." 00:00:00", $request->end_date." 23:59:59"]);
        }
        if(isset($request->status) && !empty($request->status)){
        
            $advisory = $advisory->where('status', 'like', '%' .$request->status . '%');
        }
        if(isset($request->advisor) && !empty($request->advisor)){
        
            $advisory = $advisory->where('advisor_id', $request->advisor);
        }
        if(isset($request->rating) && !empty($request->rating)){
        
            $advisory = $advisory->where('rating', $request->rating);
        }
            $advisory = $advisory->latest()->get();
        
       
        return view('admin.reports.advisory',compact('advisory'));  
    }
    
    public function paymentReport(Request $request)
    {
            
            $payment = new Paytm();
            
            if(isset($request->start_date) && !empty($request->start_date) && isset($request->end_date) && !empty($request->end_date))
            {
                $payment = $payment->whereBetween('payments.created_at', [$request->start_date." 00:00:00", $request->end_date." 23:59:59"]);
            }
            if(isset($request->advisor) && !empty($request->advisor)){
            
                $payment = $payment->where('advisor_id', $request->advisor);
            }
            /*  if(isset($request->advisory_type) && !empty($request->advisory_type)){
            
                $payment = $payment->where('advisory_type', $request->advisory_type);
            }*/
            
                $payment = $payment->with('advisory_request')->latest()->get();
                                    
                // dd($payment);
            
           
            return view('admin.reports.payment',compact('payment'));  
        }
    
    /*public function paymentReport(Request $request)
    {
        
        $payment = new Paytm();
        
        if(isset($request->start_date) && !empty($request->start_date) && isset($request->end_date) && !empty($request->end_date))
        {
            $payment = $payment->whereBetween('paytms.created_at', [$request->start_date." 00:00:00", $request->end_date." 23:59:59"]);
        }
        if(isset($request->advisor) && !empty($request->advisor)){
        
            $payment = $payment->where('advisor_id', $request->advisor);
        }
        if(isset($request->advisory_type) && !empty($request->advisory_type)){
        
            $payment = $payment->where('advisory_type', $request->advisory_type);
        }
        
            $payment = $payment->select('paytms.*')
                                // ->leftjoin('advisory_listing','advisory_id','=','advisory_listing.id')
                                ->leftjoin('requirements','advisory_id','=','requirements.id')
                                ->latest()->get();
            
            // SELECT payments.*,posts.slug as post_slug,requirements.slug as req_slug FROM `payments`

            // LEFT join posts on advisory_id = posts.id
            //     LEFT JOIN requirements on advisory_id = requirements.id
        
       
        return view('admin.reports.payment',compact('payment'));  
    }*/
	
}
