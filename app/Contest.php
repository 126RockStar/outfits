<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    
    protected $fillable=['user_id','title','category','sub_category','description','participants','prize_description','is_prize_featured','file','thumbnail','file_type','post','status','is_featured'];

    public function getCategory(){
        return $this->hasOne('App\Category','id','category');
    }
    
    public function getSubCategory(){
        return $this->hasOne('App\SubCategory','id','sub_category');
    }

    public function getCreator(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function getParticipants(){
        return $this->hasMany('App\ContestParticipant','contest_id','id');
    }
    public function amIjoined(){
        return $this->hasOne('App\ContestParticipant','contest_id','id')->where('user_id',Auth::id());
    }
}
