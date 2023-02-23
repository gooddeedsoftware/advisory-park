<?php
use Illuminate\Http\Request;
use App\Models\{User,Category,Skill,Tag,Field,Requirement,Post,Like,Comment,Save,Following,Follower,AdvisoryListing,AdvisoryRequest};

function getPostCategories($categories = null){
    if($categories){
        $cats = explode(',',$categories);
        $data =   Category::whereIn('id',$cats)->pluck('name','id');
        return $data;  
    }
}

function getPostSkills($skills = null){
    if($skills){
        $skill = explode(',',$skills);
        $data =   Skill::whereIn('id',$skill)->pluck('name','id');
        return $data;  
    }
}

function getPostTags($tags = null){
    if($tags){
        $tag = explode(',',$tags);
        $data =   Tag::whereIn('id',$tag)->pluck('name','id');
        return $data;  
    }
}

function getPostFields($fields = null){
    if($fields){
        $field = explode(',',$fields);
        $data =   Field::whereIn('id',$field)->pluck('name','id');
        return $data;  
    }
}

function addNewCategory($request_){
    $data = [];
    $new_entries = [];
    foreach($request_ as $v){
        $cat = Category::find($v);
        if(!empty($cat)){
            $data[] = $cat->id; 
        }else{
            $new_entries[] = $v;
        }
    }

    $result = [];
    if(count($data) !== count($request_)){
        $new = Category::addNewCategories($new_entries);
        if(!empty($new)){
            $result = array_merge($new, $data);;
        }
    }

    return $result;
}

/*function addNewSkill($request_){
    $data = [];
    $new_entries = [];
    foreach($request_ as $v){
        $skill = Skill::find($v);
        if(!empty($skill)){
            $data[] = $skill->id; 
        }else{
            $new_entries[] = $v;
        }
    }

    $result = [];
    if(count($data) !== count($request_)){
        $new = Skill::addNewSkills($new_entries);
        if(!empty($new)){
            $result = array_merge($new, $data);;
        }
    }

    return $result;
}*/

function addNewField($request_){
    $data = [];
    $new_entries = [];
    foreach($request_ as $v){
        $skill = Field::find($v);
        if(!empty($skill)){
            $data[] = $skill->id; 
        }else{
            $new_entries[] = $v;
        }
    }

    $result = [];
    if(count($data) !== count($request_)){
        $new = Field::addNewFields($new_entries);
        if(!empty($new)){
            $result = array_merge($new, $data);;
        }
    }

    return $result;
}

function addNewTag($request_){
    $data = [];
    $new_entries = [];
    foreach($request_ as $v){
        $tag = Tag::find($v);
        if(!empty($tag)){
            $data[] = $tag->id; 
        }else{
            $new_entries[] = $v;
        }
    }

    $result = [];
    if(count($data) !== count($request_)){
        $new = Tag::addNewTags($new_entries);
        if(!empty($new)){
            $result = array_merge($new, $data);;
        }
    }

    return $result;
}


function getNameById($id)
{
   $name = User::whereId($id)->first(['name']);
   return $name->name;

}

function getTimeAgo($date)
{
    return $date->diffForHumans();

}

function getAdvisoryStatus($status){
    if($status == '1'){
        return 'Pending';
    }
    else if($status == '2'){
        return 'Accepted';
    }
    else if($status == '3'){
        return 'Rejected';
    }
    else if($status == '4'){
        return 'Payment Done';
    }
    else if($status == '5'){
        return 'Completed';
    }
    else if($status == '6'){
        return 'Incompleted';
    }
    
}

function portalCharge($fees)
{
    
    return $amount = ((float)$fees*20)/100;
    
    
}

?>