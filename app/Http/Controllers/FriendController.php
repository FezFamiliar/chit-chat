<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\FriendRequestInbound;
class FriendController extends Controller
{
    
    public function getFriends(){

       

        $req = Auth::user()->getFriendReq();
        

    	return view('pages.friends')->with('requests',$req);
    }


    public function Add($user){


    	$user = User::where('name' ,$user)->first();

    	if(!$user){    // cant add user that doesnt exist

    		return redirect()->route('timeline')->with('info','That user could not be found.');
    	}


        if(Auth::user()->id === $user->id){    // cant add yourself

            return redirect()->route('timeline');
        }


    	if(Auth::user()->hasFriendReqPending($user) || $user->hasFriendReqPending(Auth::user())){  // cant add friend twice

    		return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend request already pending.');
    	}


    	if(Auth::user()->isFriendsWith($user)){ // you guys are already buddies, you cant add him twice.

    		return redirect()->route('user.profile',['username' => $user->name])->with('info','You are already friends.');
    	}


     
    	Auth::user()->addFriend($user);
        $user->notify(new FriendRequestInbound(Auth::user()->name)); // notify the user via email that he has a friend request from me
    	return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request Sent.');
    }

    public function Accept($user){

        $user = User::where('name' ,$user)->first();
        
        if(!$user){

            return redirect()->route('timeline')->with('info','That user could not be found.');
        }

        if(Auth::user()->isFriendsWith($user)){ // you guys are already buddies, you cant accept him twice.

            return redirect()->route('user.profile',['username' => $user->name])->with('info','You are already friends.');
        }
        
        if(Auth::user()->id === $user->id){    

            return redirect()->route('timeline');
        }

        if(!Auth::user()->hasFriendReqReceived($user)){

        
            return redirect()->route('timeline')->with('info','You didn\'t receive a friend request from that user.');
        }
    




        Auth::user()->acceptFriendReq($user);
       

        return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request accepted.');

    }



    public function Ignore($user){

        $user = User::where('name' ,$user)->first();
        

        if(!$user){

            return redirect()->route('timeline')->with('info','That user could not be found.');
        }

        if(Auth::user()->isFriendsWith($user)){ 

            return redirect()->route('user.profile',['username' => $user->name])->with('info','You are already friends.');
        }

        if(Auth::user()->id === $user->id){    

            return redirect()->route('timeline');
        }



        if(!Auth::user()->hasFriendReqReceived($user)){

            return redirect()->route('timeline')->with('info','You didn\'t receive a friend request from that user.');
        }

        
        DB::delete('DELETE FROM friends WHERE friend_id = ' . $user->id . ' AND user_id = ' . Auth::user()->id);

        return redirect()->route('user.profile',['username' => $user->name])->with('info','Friend Request Ignored.');
    }


    public function Unfriend($user){


        $user = User::where('name' ,$user)->first();
        
        if(!$user){

            return redirect()->route('timeline')->with('info','That user could not be found.');
        }


        if(Auth::user()->id === $user->id){    // cant unfriend yourself

            return redirect()->route('timeline')->with('info','You can\'t unfriend yourself');
        }


        if(!Auth::user()->isFriendsWith($user)){
            
            return redirect()->route('user.profile',['username' => $user->name])->with('info','You are not friends.');
        }
    



       DB::delete('DELETE FROM friends WHERE (user_id = ' . $user->id . ' AND friend_id = ' . Auth::user()->id . ') OR user_id = ' . Auth::user()->id . ' AND friend_id = ' . $user->id);
       

        return redirect()->route('user.profile',['username' => $user->name])->with('info','Unfriended.');
    }
}
