<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   

    public function friendsOfMine(){


        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }

    public function friendOf(){
        return $this->belongsToMany('App\User','friends','friend_id','user_id');
    }


    public function friends(){
    
            // friends of this user where the user has accepted
        // where pivot acepted true basically means, WHERE accepted = true pivot table is the friuends table
        return $this->friendsOfMine()->wherePivot('accepted','1')->get()->merge($this->friendOf()->wherePivot('accepted','1')->get());  
    }
}
