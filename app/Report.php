<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable=['user_id','contest_id','entry_id','reason','attachment','status'];

    public function getCreator(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function getContest(){
        return $this->hasOne('App\Contest','id','contest_id');
    }
    
    public function getEntry(){
        return $this->hasOne('App\ContestParticipant','id','entry_id');
    }
}
