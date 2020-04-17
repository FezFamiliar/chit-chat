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

        $z = [];
        $settings_all = DB::select(DB::raw('SELECT * FROM settings'));    

        $whichs = DB::table('settings_state')->where('user_id', Auth::user()->id)->get('setting_id')->toArray();

        foreach ($whichs  as $key => $value) {
           array_push($z, $whichs[$key]->setting_id);
        }

    	return view('settings.settings',['settings_all' => $settings_all, 'z' => $z]);
    }


    public function toggleSettings(Request $request, $s_id)
    {

        $setting = Setting::find($s_id);

        // echo '<pre>';
        // print_r($setting);
        // echo '</pre>';

    	$toggle = $request->input('toggle');
 
        if($toggle !=  0) 
        {
           DB::table('settings_state')->insert(['user_id' => Auth::user()->id, 'setting_id' => $s_id, 'created_at' => NOW(), 'updated_at' => NOW()]);
           $request->session()->push('settings', $s_id);
        }
    	else  
        {

            DB::delete('DELETE FROM settings_state WHERE setting_id = ' . $s_id . ' AND user_id = ' . Auth::user()->id);
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
