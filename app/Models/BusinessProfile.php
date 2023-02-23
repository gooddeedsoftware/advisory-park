<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;
    
    protected $table = 'business_profile';
    
    protected $guarded = ['id'];
    
    public function users(){
        
        return $this->belongsTo(User::class,'user_id');
    }
    
}