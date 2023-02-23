<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Artisan;
class AdvisoryRequest extends Model
{
    use HasFactory;
    
    protected $table = 'advisory_requests';
    
    protected $guarded = ['id'];
    
    public static function boot()
    {   
        parent::boot();
        self::created(function($model){
            Artisan::call('notification:advisory_request', ['id' => $model->id]);
        });
    }
    
    public function advisors(){
        
        return $this->belongsTo(User::class,'advisor_id');
    }

    public function users(){
        
        return $this->belongsTo(User::class,'user_id');
    }

    public function types(){
        
        return $this->belongsTo(Type::class,'type','id');
    }
    public function categories(){
        
        return $this->belongsTo(Category::class,'category');
    }
}
