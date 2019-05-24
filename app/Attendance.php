<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function rombel()
    {
    	return $this->hasOne('App\Rombel','id','rombel_id');
    }
}
