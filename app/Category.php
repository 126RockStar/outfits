<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name'];

    public function getSubCategories(){
      return $this->hasMany('App\SubCategory','category_id','id');
    }



}
