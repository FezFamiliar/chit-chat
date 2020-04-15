<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

	protected $table = 'settings';

    public function user(){

    	return $this->belongsTo('App\User','user_id');    // user_id is the foreign key
    }
}
