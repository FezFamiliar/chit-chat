<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($username){


    	$user = User::where('name',$username)->first();
    	if($user == null){
    		abort(404);
    	}
    	return view('profile.user')->with('user',$user);
    }


    public function getEdit(){

    	return view('profile.edit');
    }

    public function postEdit(Request $request){



    	$this->validate($request,[

    		'name' => 'max:50',
    		'location' => 'max:35'

    	]);
    	$name = $request->input('name');
    	$location = $request->input('location');

    

    	Auth::user()->update([
    		'name' => $request->input('name'),
    		'location' => $request->input('location')


    	]);

    	return redirect()->route('profile.edit')->with('info','Your profile has been updated!');

    }
}
