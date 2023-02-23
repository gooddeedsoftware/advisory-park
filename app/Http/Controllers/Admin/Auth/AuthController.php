<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
class AuthController extends Controller
{
    
    
	public function login(request $request)
    {   

        return view('admin.auth.login');
    }
    
    public function loginPost(request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', 
            'password' => 'required', 

        ]); 
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $email      = $request->email;
        $password   = $request->password;
        
        // dd($request);
        $remember_me = $request->has('remember_me') ? true : false;
        
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            
            if(Auth::user()->type == 'admin'){
                return redirect()->route('dashboard')->with('success', 'Login Successfully.');
            }else{
                Auth::logout();
                return redirect()->back()->with('error', 'Admin access only!');
            }
            
        }else{
             
            return redirect()->route('admin.login')->with('error', 'These credentials do not match our records.');
        } 
           
    }
    
    public function logout()
    {   
        
        Auth::logout();
        
        return redirect()->route('admin.login')->with('error','Logout Successfully!');
    }
    
}
