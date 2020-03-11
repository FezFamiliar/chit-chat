<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
}
