<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;
    
    protected $table = 'saves';
    
    protected $guarded = ['id'];
    
    public function posts(){
        
       return $this->hasOne(Post::class,'id','blog_id');
       
    }
    
    public function users(){
        
       return $this->hasOne(User::class,'id','user_id');
       
    }

    public function comments(){
        
      $instance = $this->hasMany(Comment::class,'blog_id','id');
      $instance->getQuery()->where('blog_type', 'post');
      
      return $instance;
  }
    
}
