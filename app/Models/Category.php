<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    
    protected $guarded = ['id'];

    public function addNewCategories($arr)
    {
        $category_id = [];
        $_this = new self;
        
        if(!empty($arr)){
            foreach($arr as $v){
                $insert = $_this->create(['name' => $v]);
                $category_id[] = $insert->id;
            }
    
            return $category_id;
        }else{
            return [];
        }
    }
}
