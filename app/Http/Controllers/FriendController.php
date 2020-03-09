<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
class FriendController extends Controller
{
    
    public function getFriends(){

       

        $req = Auth::user()->getFriendReq();
        

    	return view('pages.friends')->with('requests',$req);
    }


    public function Add($user){


    	$user = User::where('name' ,$user)->first();

    	if(!$user){

    		return redirect()->route('timeline')->with('info','That user could not be found');
    	}


        if(Auth::user()->id === $user->id){
            return redirect()->route('timeline');
        }


    	if(Auth::user()->hasFriendReqPending($user) || $user->hasFriendReqPending(Auth::user())){

    			return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend request already pending');
    	}


    	if(Auth::user()->isFriendsWith($user)){
    		return redirect()->route('user.profile',['username' => $user->name])->with('info','You are already friends');
    	}



    	Auth::user()->addFriend($user);

    	return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request Sent');
    }

    public function Accept($user){

        $user = User::where('name' ,$user)->first();
        
        if(!$user){

            return redirect()->route('timeline')->with('info','That user could not be found');
        }

    
        if(!Auth::user()->hasFriendReqReceived($user)){

        
            return redirect()->route('timeline');
        }
    

        Auth::user()->acceptFriendReq($user);
       

        return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request accepted');

    }



    public function Ignore($user){

        $user = User::where('name' ,$user)->first();
        

        if(!$user){

            return redirect()->route('timeline')->with('info','That user could not be found.');
        }

        DB::delete('DELETE FROM friends WHERE friend_id = ' . $user->id);

        return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request Ignored.');
    }
}
