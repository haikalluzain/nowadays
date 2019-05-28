<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $guarded = [];

    public function major()
    {
    	return $this->belongsTo('App\Major','major_id','id');
    }
}
