<?php

namespace App\Http\Controllers;

use App\CustomClasses\Api_Helper;
use App\CustomClasses\TrackerGG_Helper;
use App\Models\Bet;
use App\Models\BetMain;
use App\Models\Betting;
use App\Models\GameLabel;
use App\Models\GameRoom;
use App\Models\Livestream;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserLabel;
use App\Models\UserRoom;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Session;

class StreamController extends Controller
{

    // this function will show the details of twitch video
    public function index($id)
    {
       
      
        $headers = [
            "Authorization: Bearer j82uxomc23bn16320idq8ot75zx6m5",
            "Client-Id: 43s48r8zwlgnvwpk5xsc1gk7efa3js"
        ];
       
           $url = "https://api.twitch.tv/helix/streams?user_id=".$id;
          $APIHELPER = new Api_Helper($url, $headers, true, true);
           $response = $APIHELPER->CallApi();

        if(!$response['data']){
            return redirect()->back();
        }
       
        $livestream = Livestream::where('stream_id',$response['data']['0']['id'])->where('type','twitch')->first();
      
        $setting=Setting::find(1);// get setting 
        $uid = auth()->user()->id;
        if(!$livestream ){
            $data['stream_id'] = $response['data']['0']['id'];
            $data['status'] = 'started';
            $data['type'] = 'twitch';
            $data['name'] = $response['data'][0]["user_name"];
            $data['user_id'] =   $response['data']['0']['user_id'];
            $livestream = Livestream::create($data);

        }
       
       
       
        $game_name = "";
        $player_stats = null;

//echo "<br>i m here1";

        if (isset($response['data'][0])) {
            if ($response['data'][0]["game_name"] == "Apex Legends") {
                $game_name = "Apex Legends";
            } else if ($response['data'][0]["game_name"] == "Counter-Strike: Global Offensive") {
                $game_name = "CSGO";

            } else {
                $game_name = $response['data'][0]["game_name"];
            }
            $TrackerGG_Helper = new TrackerGG_Helper($game_name, $response['data'][0]['user_name']);
            $player_stats = $TrackerGG_Helper->GetTrackerInfo();
        }
//echo "<br>i m here12";
        if (@$response['data'][0]['user_id']) {
            //active bets
            $game_id = $response['data'][0]['user_id'];//user_id is a game_id in api
        } else {
            $game_id = 0;
        }

        // $active_bets = Bet::with('user')->where('game_id', $game_id)->limit(1)->orderBy('created_at', 'desc')->get();
        $betting_masters = Betting::where('is_active', 1)->orderBy('betting_amount', 'asc')->get();
       
	   $active_bets = BetMain::with(['master','user','bets'])
            ->select("bet_main.*",
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id) as total"),
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' ) as is_add_bet"),
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' AND is_claimed  = 1  ) as is_claim_bet")
							 )
            ->where('livestream_id', $livestream->id)->orderBy('created_at', 'desc')->get();
	  	
                    $conversion = \DB::table('conversion')->first();

        $email = null;
        if(auth()->check()){
            $email = auth()->user()->email;
        }
       
//echo "<br>i m here15";
        $count_label = 0;
        $chk_label = '';
        $count_bet = 0;
        $user_room_names = '';
        $current_room_names = '';
        $rm_name = '';
        $l_name = '';
        $label_name = '';
        $r = '';
		//echo "<br>i m here16";
        if ($email > 0) {
			$uname = auth()->user();
           
            //$uname = Users::select('Username', 'id')->where('Email', $email)->first();
            $user_id = $uname->id;

            $count_label = UserLabel::where('user_id', $user_id)->get()->count();
            $chk_label = UserLabel::where('user_id', $user_id)->get();

            $l_name = GameLabel::with('userlabel')->where('user_id', $user_id)
                ->where('game_id',$livestream->id)->first();

            if ($l_name != '') {
                $label_name = $l_name->userlabel->label_game;
            }


            // room

            $user_id = $uname->id;

            if ($count_bet = Bet::where('user_id', $user_id)->count() > 0) {
                $chk_first_bet = Bet::select('user_id', 'id', 'game_id')->where('game_id',  $livestream->id)->orderBy('id', 'asc')->limit(1)->first();
                if ($chk_first_bet != '') {
                    $bet_user_id = $chk_first_bet->user_id;
                } else {
                    $bet_user_id = 'empty';
                }


                if ($bet_user_id == $user_id) {

                    $count_game_room = GameRoom::select('user_id', 'game_id')->where('user_id', $user_id)
                        ->where('game_id',  $livestream->id)->count();


                    if ($count_game_room > 0) {
                        $user_room_names = UserRoom::select('id', 'room_name', 'user_id')->where('user_id', $user_id)->get();
                        $current_room_names = GameRoom::with('game_room')
                            ->where('user_id', $user_id)->where('game_id',  $livestream->id)->first();

                        $count_bet = 1;//select box
                    } else {

                        $count_user_room_names = UserRoom::select('id', 'room_name', 'user_id')->where('user_id', $user_id)->count();
                        // return $user_room_names;
                        if ($count_user_room_names > 0) {
                            $user_room_names = UserRoom::select('id', 'room_name', 'user_id')->where('user_id', $user_id)->get();
                            $count_bet = 4;//user having room on userroom table
                        } else {
                            $count_bet = 2;//create room
                        }
                        // return $user_room_names;
                    }
                } else {
                    $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id',  $livestream->id)->first();

                    if ($r != '') {
                        $rm_name = $r->game_room->room_name;
                        $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
                    } else {
                        $count_bet = 0;//no game id found on bet of this user so he only sees existing room name or anonymous
                    }
                }
            } else {
//                $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id', $game_id)->first();
                if ($r != '') {
                    $rm_name = $r->game_room->room_name;
                    $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
                } else {
                    $count_bet = 0;
                }

            }
        } else {
            $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id',  $livestream->id)->first();
            if ($r != '') {
                $rm_name = $r->game_room->room_name;
                $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
            } else {
                $count_bet = 0;
            }

        }
        $fliter = __('filter');
       //$response['data'][0]['user_id']=10;
        // room
		
		//echo "<br>i m here17";
        $pot_amount = Bet::where('game_id', $livestream->id)->sum('total_amount');
        $setting=Setting::find(1);
        $betting_masters = Betting::where('is_active',1)->get();
 // echo "<br>i m here18";     
        return view('streams/stream', ['data' => $response,'setting'=>$setting,'pot_amount'=> $pot_amount,'active_bets'=>$active_bets,'betting_masters'=>$betting_masters,'livestream'=>$livestream, 'game_name' => $game_name, 'player_stats' => $player_stats, 'active_bets' => $active_bets, 'conversion' => $conversion, 'count_label' => $count_label, 'chk_label' => $chk_label, 'label_name' => $label_name, 'l_name' => $l_name, 'count_bet' => $count_bet, 'email' => $email, 'user_room_names' => $user_room_names, 'current_room_names' => $current_room_names, 'rm_name' => $rm_name]);
    }

    // this function will display the twitch stream where stream_id is required
    public function show($id){
       

        $livestream = Livestream::where('stream_id',$id)->where('type','twitch')->first();
   
        $headers = [
            "Authorization: Bearer v45zugzlsli3mju6wiz74ragdzz77l",
            "Client-Id: 43s48r8zwlgnvwpk5xsc1gk7efa3js"
        ];
        //   $url = "https://api.twitch.tv/kraken/channels/40589380232/videos";
        //  $url= 'https://api.twitch.tv/helix/videos?user_id='.$id;
           $url = "https://api.twitch.tv/helix/streams?user_id=".$livestream->user_id;
          $APIHELPER = new Api_Helper($url, $headers, true, true);
        $response = $APIHELPER->CallApi();
         $vid  =   'https://api.twitch.tv/helix/videos?user_id='.$livestream->user_id;
        // dd( $response);
        $APIHELPER = new Api_Helper($vid, $headers, true, true);
        $user_video = $APIHELPER->CallApi();
        
       
        foreach($user_video['data'] as $dataw){
           
            if($dataw['stream_id'] == $livestream->stream_id){
            
                $out_video = $dataw;
            }
        }
     
        if($dataw){
        // return redirect()->back();
        return view('streams.index',['dataw'=>$out_video]);
        }
        return redirect()->back();
     
    }

}
