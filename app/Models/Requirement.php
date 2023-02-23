<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Artisan;
use Illuminate\Support\Str;

class Requirement extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'requirements';
    
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            
            self::whereId($model->id)->update([
                    'slug' => Str::slug($model->title."-".$model->id),
                    ]);
            
            Artisan::call('notification:create_requirement', ['id' => $model->id]);
        });
    }
    
    public function users(){
        
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function comments(){
        
        $instance = $this->hasMany(Comment::class,'blog_id','id');
        $instance->getQuery()->where('blog_type', 'requirement')->orderby('id','desc');
        
        return $instance;
    }
    
    public function categories(){
        
        return $this->belongsTo(Category::class,'category');
    }
    
    public function skills(){
        
        return $this->belongsTo(Skill::class,'skill');
    }
    
    public function tags(){
        
        return $this->belongsTo(Tag::class,'tag');
    }

    
}
