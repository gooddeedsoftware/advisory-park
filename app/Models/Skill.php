<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    
    protected $table = 'skills';
    
    protected $guarded = ['id'];

    public function addNewSkills($arr)
    {
        $skiils_id = [];
        $_this = new self;
        
        if(!empty($arr)){
            foreach($arr as $v){
                $insert = $_this->create(['name' => strtoupper($v)]);
                $skiils_id[] = $insert->id;
            }
    
            return $skiils_id;
        }else{
            return [];
        }
    }
}
