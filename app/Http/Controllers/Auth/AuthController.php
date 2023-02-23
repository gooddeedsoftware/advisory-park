<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User,UserVerify};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Illuminate\Support\Str;
use Mail; 
use Session;

class AuthController extends Controller
{
    
    
	public function login(request $request)
    {   

        return view('login');
    }
    
    public function loginPost(request $request)
    {
    //   dd($request->all());
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
       
        if (Auth::attempt(['email' => $email, 'password' => $password]/*, $remember_me*/)) {
            
            if(Auth::user()->is_email_verified == '1'){
                
                Session::put('type', $request->type);
               
                User::whereId(Auth::user()->id)->update(['is_active'=>1,'last_login_at'=>date('Y-m-d h:i:s'),'session_expire'=>date('Y-m-d h:i:s',strtotime('+30 minutes'))]);
                
                return redirect()->route('index')->with('success', 'Login Successfully.');
            }
            else{
                User::whereId(Auth::user()->id)->update(['is_active'=>0]);
                Auth::logout();
                return redirect()->route('login')->with('error', 'Please verify your e-mail.');
            }
        }else{
                 
            return redirect()->route('login')->with('error', 'These credentials do not match our records.');
        } 
           
    }
    
    public function registerPost(request $request)
    {   
        // dd($request);
        $validator = Validator::make($request->all(), [
               
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:users,email',
                'password'          =>      'required|alpha_num|min:5',
                'confirm_password'  =>      'required|same:password',
        ]);
            
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
          
            $user = User::create([
                'name' => trim($request->input('name')),
                'email' => strtolower($request->input('email')),
                'password' => Hash::make($request->input('password')),
                'plain_password' => $request->input('password'),
                'type'=> 'user',
                // 'advisory_park_id'=> $code,
            ]);
            
            
            $token = Str::random(64);
  
            UserVerify::create([
                  'user_id' => $user->id, 
                  'token' => $token
                ]);
                
            /* try{
                
                Mail::send('emails.email-verification', ['token' => $token], function($message) use($request){
                      $message->to($request->email);
                    //   $message->to('rohitsharma.gooddeedsoftware@gmail.com');
                      $message->subject('Email Verification Mail');
                  });
                  
            }catch(Exception $e){
                dd($e->message());
            } */
           return redirect()->route('login')->with('success', 'Your account is created. Login Now!');
    }
    
    /*function strplusone($string)    
    {
    
    	$invoice =  preg_replace_callback( "|(\d+)|", function($matches){
    
    		if(isset($matches[1]))
    
    	    {
    
    	        $length = strlen($matches[1]);
    
    	        return sprintf("%0".$length."d", ++$matches[1]);
    
    	    }
    
    	}, $string);
    
    	return $invoice;
    
    }*/
    
    public function logout()
    {   
        if(Auth::check()){
            User::whereId(Auth::user()->id)->update(['is_active'=>0,'session_expire'=>date('Y-m-d h:i:s')]);
            Auth::logout();
        }

        return redirect()->route('login')->with('error', 'Logout Successfully.');
    }
    
   
    public function changePassword(Request $request) {
        
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
           
            return redirect()->back()->with("error","Your current password does not match with the password.");
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
          
            return redirect()->back()->with("error","New Password can't be same as your current password.");
        }

        $validator = Validator::make($request->all(), [
            'current_password'  =>  'required',
            'new_password'      =>  'required|min:5',
            'confirm_password'  =>  'required|same:new_password',
        ]);
        
         if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

      
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }
    
    public function showForgetPasswordForm()
      {
         return view('auth.forget-password');
      }
  
      
    public function submitForgetPasswordForm(Request $request)
    {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('auth.email.forgot-password', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('success', 'We have e-mailed your password reset link!');
    }
    
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
                return redirect()->route('login')->with('success', $message);
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                return redirect()->route('login')->with('success', $message);
            }
        }
  
      return redirect()->route('login')->with('error', $message);
    }
}
