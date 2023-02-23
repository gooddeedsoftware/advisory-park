<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'advisory_park_id',
        'type',
        'email',
        'password',
        'plain_password',
        'is_email_verified',
        'image',
        'contact',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'work_status',
        'language_known',
        'overview',
        'qualifications',
        'about_us',
        'education',
        'experience',
        'google_id',
        'is_active',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->advisory_park_id = 'ADVPK' . str_pad($model->id, 5, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    public static function getSkilledUser($skill = null)
    {   
        \DB::enableQueryLog();

        if(!$skill){
            return [];
        }
        $s = explode(',',$skill);

        $query = Self::where(function($q) use ($s){
            foreach($s as $k){
                $q->orWhereRaw("FIND_IN_SET($k, skill)");
            }  
        });  
       return $query->where('id','!=',Auth::user()->id)->get(['id','type']); 
        
        // dd(\DB::getQueryLog()); 
        // dd($query);

        // return $query;
    }
}
