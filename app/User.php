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
    
        return $this->friendsOfMine()->wherePivot('accepted','1')->get()->merge($this->friendOf()->wherePivot('accepted','1')->get());  
    }

    public function getFriendReq(){

        return $this->friendsOfMine()->wherePivot('accepted','0')->get();
    }


    public function posts(){

        return $this->hasMany('App\Post','user_id');
    }
    public function getFriendReqPending(){

        return $this->friendOf()->wherePivot('accepted','0')->get();
    }


    public function hasFriendReqPending(User $user){

        return (bool)$this->getFriendReqPending()->where('id',$user->id)->count();
    }


    public function hasFriendReqReceived(User $user){
            
        return (bool)$this->getFriendReq()->where('id',$user->id)->count();
    }

    public function addFriend(User $user){

         $this->friendOf()->attach($user->id, ['accepted' => '0','created_at' => NOW(), 'updated_at' => NOW()]);

    }

    public function acceptFriendReq(User $user){

        $this->getFriendReq()->where('id',$user->id)->first()->pivot->update(['accepted' => '1','updated_at' => NOW()]);
    }

    public function isFriendsWith(User $user){

        return (bool) $this->friends()->where('id',$user->id)->count();
    }


}
