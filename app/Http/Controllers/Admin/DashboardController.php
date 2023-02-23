<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\{User,Post,Requirement,Paytm};
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    
    
	public function dashboard()
    {
            $users = User::where('type','user')->count();
            $posts = Post::count();
            $requirements = Requirement::count();
            $wallet = User::whereId(Auth::user()->id)->first('wallet');
            
            $advisory = Paytm::with('advisor','user','advisory')
                        ->selectRaw('*, sum(amount) as amount')
                        ->where('status','TXN_SUCCESS')
                        ->where('payment_type','From User Payment')
                        ->groupby('advisor_id')
                        ->latest()
                        ->get();
            
            // dd($advisory);
            
			return view('admin.dashboard',compact('users','posts','requirements','wallet','advisory'));
       
    }
	
}
