<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    public function likeable(){
    	
    	return $this->morphTo(); // im a polymorphic relationship
    }

    public function user(){

    	return $this->belongsTo('App\User','user_id');    // user_id is the foreign key
    }
}
