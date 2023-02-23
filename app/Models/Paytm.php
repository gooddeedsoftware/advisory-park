<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paytm extends Model
{
    use HasFactory;

    protected $table = 'payments';
    
    protected $guarded = ['id'];
    
    public function advisory(){
        
        return $this->belongsTo(Requirement::class,'advisory_id');
    }
    public function advisor(){
        
        return $this->belongsTo(User::class,'advisor_id');
    }
    public function sender(){
        
        return $this->belongsTo(User::class,'sender_id');
    }
    public function reciever(){
        
        return $this->belongsTo(User::class,'reciever_id');
    }
    
    public function advisory_request(){
        
        return $this->belongsTo(AdvisoryRequest::class,'advisory_request_id');
    }
    
}
