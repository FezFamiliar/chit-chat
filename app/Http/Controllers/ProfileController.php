<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
class ProfileController extends Controller
{
    public function getProfile($username){


    	$user = User::where('name',$username)->first();
    	if($user == null){
    		abort(404);
    	}
    	return view('profile.user')->with('user',$user);
    }
}
