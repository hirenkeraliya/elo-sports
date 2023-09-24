<?php

namespace App\Http\Controllers;

use App\CustomClasses\Api_Helper;
use App\Models\Livestream;


class IndexController extends Controller
{
    public function index()

    {
        
        $headers = [
            "Authorization: Bearer j82uxomc23bn16320idq8ot75zx6m5",
            "Client-Id: 43s48r8zwlgnvwpk5xsc1gk7efa3js",
			"Content-Type:application/json"        ];
	
        $url = "https://api.twitch.tv/helix/streams?game_id=516575&game_id=32399&game_id=33214&game_id=27471&game_id=1494&first=50";
        $APIHELPER = new Api_Helper($url, $headers, true, true);
        $data = $APIHELPER->CallApi();
		//	 $data['data']=array();
         //dd(   $data);
        //
        $livestreams = Livestream::with('user')->whereNull('type')
            ->whereNot('status', 'stopped')
            ->get();

        return view('index', compact('livestreams', 'data'));
    }
}
