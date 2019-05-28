<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorAttendance extends Model
{
    protected $guarded = [];

    public function major()
    {
    	return $this->hasOne('App\Major','id','major_id');
    }
}
