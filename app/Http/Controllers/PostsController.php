<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
class PostsController extends Controller
{
    public function Post(Request $request){

    	$this->validate($request,[
    		'post-body' => 'required|max:2000',
    	]);

    	Auth::user()->posts()->create([
    		'body' => $request->input('post-body'),
    	]);



    	return redirect()->route('timeline')->with('info','Status Posted Successfully.');
    }

    public function postReply(Request $request, $statusID){

    	

    	$this->validate($request,[
    		"reply-{$statusID}" => 'required|max:2000',
    	]);

    	

    	$find_post = Post::notReply()->find($statusID);

    	if(!$find_post){
    	
    		return redirect()->route('timeline')->with('info','that post doesnt exist');
    	}

    	if(!Auth::user()->isFriendsWith($find_post->user) && Auth::user()->id != $find_post->user->id){
    
    		return redirect()->route('timeline')->with('info','you cant do that');
    	}



    	$reply = Post::create([
    		'body' => $request->input("reply-{$statusID}")
    	])->user()->associate(Auth::user());


    	$find_post->replies()->save($reply);
    	

    	return redirect()->back();
    }
}
