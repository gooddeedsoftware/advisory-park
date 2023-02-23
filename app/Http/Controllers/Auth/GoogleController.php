<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Socialite;
use Auth;
use Hash;
use Exception;

class GoogleController extends Controller
{
    
	public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->stateless()->user();
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
             
                Auth::login($finduser);
    
                return redirect()->route('index')->with('success','Login Successfully.');
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('12345'),
                    'plain_password' => '12345',
                    'type'=> 'user'
                ]);
    
                Auth::login($newUser);
     
                 return redirect()->route('index')->with('success','Login Successfully.');
            }
    
        } catch (Exception $e) {
            dd($e);
            dd($e->getMessage());
        }
    }
}
