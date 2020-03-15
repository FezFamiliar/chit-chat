<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;

class ProfileController extends Controller
{

    public function getProfile($username){


    	$user = User::where('name',$username)->first();

    	if($user == null){
    		abort(404);
    	}
        $posts = $user->posts()->notReply()->get();
    	return view('profile.user')->with('user',$user)->with('posts' , $posts)->with('AuthUserIsFriend' , Auth::user()->isFriendswith($user));
    }


    public function getEdit(){

    	return view('profile.edit');
    }

    public function postEdit(Request $request){



    	$this->validate($request,[

    		'name' => 'required|max:50',
    		'location' => 'required|max:35'

    	]);
    	$name = $request->input('name');
    	$location = $request->input('location');


        $dir = public_path() . '\img\\';
        $target_file = $dir . basename($_FILES['profile-pic']['name']);

        
        if(file_exists($target_file)){  
            return redirect()->route('profile.edit')->with('info','The file already exists!');
        }
        
        move_uploaded_file($_FILES['profile-pic']['tmp_name'], $target_file);
        

        Image::make($target_file)->fit(80, 80)->save($target_file)->destroy();
        


    	Auth::user()->update([
    		'name' => $request->input('name'),
    		'location' => $request->input('location'),
            'profile' => $_FILES['profile-pic']['name']

    	]);

    	return redirect()->route('profile.edit')->with('info','Your profile has been updated!');

    }
}
