<?php

namespace App\Http\Controllers;

use App\Models\Livestream;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Bet;

class MyStreamsController extends Controller
{
    public function index()
    {

        // user
        $user = auth()->user();


//   $streams = DB::table("livestreams") 
// 		 ->select("livestreams.*", 
// 		                     DB::raw("( select sum( bet_main.streamer_fee)  from bet_main    where bet_main.livestream_id =  livestreams.id  ) as streamer_fee"),
// 		                     DB::raw("( select sum( bets.vig_amount)  from bets    where bets.game_id =  livestreams.id  ) as vig_amount"))
			
// 			->where('user_id', $user->id)->paginate(10);  
	    $uId = $user->id;
       
        $streams = Livestream::whereHas('bets',function($query) use( $uId){
            $query->where('user_id',$uId);
        },'betMain',function($query) use( $uId){
            $query->where('user_id',$uId);
        })->where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10); 
        return view('my_streams.index', compact('streams'));

    }


public function getMyStreamBettingList($id){ 
$game_info =Livestream::where('id', $id)->first();
		  $records = Bet::with('betmain')->where('game_id', $id)->orderBy('id', 'desc')->paginate(10);  
			return view('MyStreamBets.index',  ['records' => $records ,'game_info'=>$game_info  ]);
}
}
