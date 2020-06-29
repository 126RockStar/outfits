<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model
{
    use SoftDeletes;
    
    protected $fillable=['user_id','title','category','sub_category','description','participants','prize_description','photo'];

    public function getCategory(){
        return $this->hasOne('App\Category','id','category');
    }
    public function getSubCategory(){
        return $this->hasOne('App\SubCategory','id','sub_category');
    }
}
