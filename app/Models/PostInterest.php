<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostInterest extends Model
{
    use HasFactory;
    
    protected $table = 'post_interest';
    
    protected $guarded = ['id'];

    public function users(){
        
        return $this->hasOne(User::class,'id','entity_id');
        
    }

    public function posts(){
        
        return $this->hasOne(Post::class,'id','post_id');
        
    }
}
