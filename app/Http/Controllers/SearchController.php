<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
class SearchController extends Controller
{
    public function GetResults(Request $request){

    	$query = $request->input('query');
    	if(!$query){

			return redirect()->route('/');
			
		}

    	$users = user::where('name', 'LIKE', "%{$query}%")->get();

    	return view('search.results')->with('users',$users);
    }
}
