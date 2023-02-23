<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    
    protected $table = 'complains';
    
    protected $guarded = ['id'];

    public function users()
    {
       return $this->hasOne(User::class,'id','created_by');
    }
    
    public function lead()
    {
       return $this->hasOne(AdvisoryRequest::class,'id','lead_id');
    }
}
