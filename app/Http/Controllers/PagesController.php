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

}
