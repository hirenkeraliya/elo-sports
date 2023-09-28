<?php

namespace App\Http\Controllers;

use App\CustomClasses\Api_Helper;
use App\Models\Livestream;

class IndexController extends Controller
{
    public function index()
    {

        $headers = [
            "Authorization: Bearer 6ar6deazw59y62hmi4e85c92c3g6lj",
            "Client-Id: 43s48r8zwlgnvwpk5xsc1gk7efa3js",
            "Content-Type:application/json"        ];

        $url = "https://api.twitch.tv/helix/streams?game_id=516575&game_id=32399&game_id=33214&game_id=27471&game_id=1494&first=50";
        $APIHELPER = new Api_Helper($url, $headers, true, true);
        $data = $APIHELPER->CallApi();
        // dd($data);
        //	 $data['data']=array();
        //dd(   $data);
        //
        $livestreams = Livestream::with('user')->whereNull('type')
            ->whereNot('status', 'stopped')
            ->get();

        return view('index', compact('livestreams', 'data'));
    }
}
