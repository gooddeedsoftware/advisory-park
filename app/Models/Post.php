<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Artisan;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';
    
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            
            self::whereId($model->id)->update([
                    'slug' => Str::slug($model->title."-".$model->id),
                    ]);
            
            Artisan::call('notification:create_post', ['id' => $model->id]);
        });
    }
    
    public function users(){
        
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function comments(){
        
        $instance = $this->hasMany(Comment::class,'blog_id','id');
        $instance->getQuery()->where('blog_type', 'post')->orderby('id','desc');
        
        return $instance;
    }
    
   
    public function categories(){
        
        return $this->belongsTo(Category::class,'category');
    }
    
    public function followers(){
        
        return $this->belongsTo(Followers::class,'created_by');
    }

    
}
