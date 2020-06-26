<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Post;
use Auth;
class PagesController extends Controller
{
    public function RenderHomePage(){

    	return view('home');
    }

    public function RenderTimeline(){


    	$posts = Post::notReply()->where(function($query){


    		return $query->where('user_id',Auth::user()->id)->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));
			

			})->orderBy('created_at','desc')->get();

    	return view('pages.timeline')->with('posts',$posts);
    }
}
