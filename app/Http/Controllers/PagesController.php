<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function RenderHomePage(){

    	return view('home');
    }

    public function RenderTimeline(){

    	return view('pages.timeline');
    }


    public function RenderFriends(){

    	return view('pages.friends');
    }

    public function RenderProfile(){

    	return view('pages.profile');
    }

}
