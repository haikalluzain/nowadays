<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $guarded = [];

    public function rombel()
    {
    	return $this->hasMany('App\Rombel','major_id','id');
    }
}
