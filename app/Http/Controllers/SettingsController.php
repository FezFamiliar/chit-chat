<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\User;
use Session;
class SettingsController extends Controller
{
    

    public function getSettings()
    {

    	$settings = DB::table('settings')->get();

    	return view('settings.settings')->with('settings',$settings);
    }


    public function toggleSettings(Request $request, $s_id)
    {

        $setting = Setting::find($s_id);


    	$toggle = $request->input('toggle');
 
        if($toggle !=  0) 
        {
           $request->session()->push('settings', $s_id);
        }
    	else  
        {
            foreach (Session::get('settings') as $key => $value)
            {
                    if($value ==  $s_id)
                    {
                        $request->session()->forget('settings.'.$key);
                    }
            }
        }
        

    }
}
