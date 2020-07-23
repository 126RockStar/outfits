<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable=['user_id','contest_id','entry_id','reason','attachment'];
}
