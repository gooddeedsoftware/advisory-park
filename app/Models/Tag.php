<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $table = 'tags';
    
    protected $guarded = ['id'];

    public function addNewTags($arr)
    {
        $tags_id = [];
        $_this = new self;
        
        if(!empty($arr)){
            foreach($arr as $v){
                $insert = $_this->create(['name' => $v]);
                $tags_id[] = $insert->id;
            }
    
            return $tags_id;
        }else{
            return [];
        }
    }
}
