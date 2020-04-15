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
           // DB::table('settings_state')->insert(['user_id' => Auth::user()->id, 'setting_id' => $s_id, 'created_at' => NOW(), 'updated_at' => NOW()]);

           $request->session()->push('settings', $s_id);

        }
    	else  
        {
           // DB::delete('DELETE FROM settings_state WHERE user_id = ' . Auth::user()->id . ' AND setting_id = ' . $s_id);
$request->session()->forget('settings.'.$s_id);
          /* foreach (Session::get('settings') as $key => $value)
            {
                echo $key . ' ' . $value . '<br>';
                    if($value ==  $s_id)
                    {
                        echo 'found';
                        $request->session()->forget('settings.'.$key);
                    }

            }
                
        }*/
        
}
       // return $z;
    }
}
