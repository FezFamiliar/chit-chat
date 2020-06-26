<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Chat;
class ChatController extends Controller
{
    
	public function exec()
	{

		$content = request()->content;
		event(new Chat($content));

		return redirect()->back();
	}


}
