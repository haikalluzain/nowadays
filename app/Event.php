<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   	protected $guarded = [];


   	public function user()
   	{
   		return $this->hasOne('App\User','id','admin_id');
   	}
}
