<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['sender','receivers','message','seen','deleted'];

    public function getSender(){
        return $this->hasOne('App\User','id','sender');
    }
}
