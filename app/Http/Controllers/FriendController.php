<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    
    public function getFriends(){

    	return view('pages.friends');
    }
}
