<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvisorPayment extends Model
{
    use HasFactory;
    
    protected $table = 'advisor_payments';
    
    protected $guarded = ['id'];
    
    
    public function advisor(){
        
        return $this->belongsTo(User::class,'advisor_id');
    }

    public function admin(){
        
        return $this->belongsTo(User::class,'admin_id');
    }
    

}
