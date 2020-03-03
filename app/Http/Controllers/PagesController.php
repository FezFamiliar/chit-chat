<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function RenderHomePage(){

    	return view('home');
    }



    public function RedirectTest(){

    	return redirect('/')->with('info','Signed up successfully!');
    	
    }
}
