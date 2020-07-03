<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestParticipant extends Model
{
    protected $fillable=['user_id','contest_id','file'];
}
