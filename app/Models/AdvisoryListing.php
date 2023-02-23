<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvisoryListing extends Model
{
    use HasFactory;
    
    protected $table = 'advisory_listing';
    
    protected $guarded = ['id'];
    
     public function users(){
        
        return $this->belongsTo(User::class,'added_by');
    }
    public function types(){
        
        return $this->belongsTo(Type::class,'type');
    }
    public function categories(){
        
        return $this->belongsTo(Category::class,'category');
    }
    public function field(){
        
        return $this->belongsTo(Field::class,'category');
    }
    
}
