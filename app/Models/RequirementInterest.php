<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Artisan;
class RequirementInterest extends Model
{
    use HasFactory;
    
    protected $table = 'requirement_interest';
    
    protected $guarded = ['id'];    

    public function users(){
        
        return $this->hasOne(User::class,'id','entity_id');
        
    }

    public function requirements(){
        
        return $this->hasOne(Requirement::class,'id','requirement_id');
        
    }
}
