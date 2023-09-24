<?php

namespace App\Http\Controllers\LiveStream;

use App\Events\ChatDelayEvent;
use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Betting;
use App\Models\Setting;
use Image;
use App\Models\GameLabel;
use App\Models\GameRoom;
use App\Models\Livestream;
use App\Models\SpamWords;
use App\Models\UserLabel;
use App\Models\UserRoom;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Route;
use Session;
use Termwind\Components\Span;
use App\Models\BetMain;

use Illuminate\Support\Facades\DB;

class LiveStreamController extends Controller
{


   
    // accept stream
    public function onPublish(Request $request)
    {

        $streamId = $request->name;
        $livestream = Livestream::where('stream_id', $streamId)
            ->first();

        // start live stream
        if ($livestream) {

            // check is stopped
            if ($livestream->status == "stopped") {
                return response('No', 400)->header('Content-Type', 'text/plain');
            }

            // start
            $livestream->status = 'started';
            $livestream->save();
            return response('Good', 200)->header('Content-Type', 'text/plain');
        }

        return response('No', 400)->header('Content-Type', 'text/plain');

    }

    // start stream form
    public function showStartStreamForm(Request $request)
    {

//        $email = Session::get('userid');
//        $user = Users::where('Email', $email)->first();

        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // has any stream
        $livestream = Livestream::where('user_id', $user->id)
            ->whereIn('status', ['created', 'started'])
            ->first();

        return view('live.start_stream_form', compact('livestream'));

    }

    // start stream form
    public function createNewStream(Request $request)
    {

        // image validation
        $this->validate($request, [
            'image' => ['required', 'dimensions:min_width=1200,min_height=700', 'max:5120'],
            'description'=>['required']
        ]);

//        $email = Session::get('userid');
//        $user = Users::where('Email', $email)->first();

        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // $imageName = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        // $input['file'] = time().'.'.$image->getClientOriginalExtension();
		
		
		
		
		
        $image = $request->file('image');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(370, 220, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['file']);
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['file']);
        

        // has any stream[]
        $livestream = new Livestream();
        $livestream->user_id = $user->id;
        $livestream->name = $request->name;
        $livestream->description = $request->description;
        $livestream->image =  $input['file'];
        //$livestream->stream_id = Str::replace("-", "", Str::orderedUuid());
		$livestream->stream_id =$user->stream_key;
        $livestream->status = "created";
        $livestream->save();

        // return to form
        return redirect()->route('stream.form.index');

    }

    // stop stream form
    public function stopStream(Request $request)
    {

       // dd($request->all());
//        $email = Session::get('userid');
//        $user = Users::where('Email', $email)->first();

        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }
		
		$is_addedd_data =Livestream::where('id', $request->stream_id)
            ->first();
			
		if($is_addedd_data){
			
			$stream_id_new=$is_addedd_data->stream_key.'1';
			Livestream::where('id', $is_addedd_data->id)
			   ->update([
				   'stream_id' => $stream_id_new
				]);
			
		}
		

        // has any stream
        $livestream = Livestream::where('id', $request->stream_id)
          //  ->whereIn('status', ['created', 'started'])
            ->first();

        // check is user authenticated
       //dd($livestream->user_id,$user-id);
 if ($livestream->user_id != $user->id) {
            return abort('403');
        }

        // stop if exists
        if ($livestream) {
            $livestream->status = "stopped";
            $livestream->save();
            broadcast(new ChatDelayEvent($livestream));
        }
        

        // return to form
        return redirect()->route('stream.form.index');

    }

    // live stream
    public function showStream(Request $request, $id)
    {
     
        $livestream = Livestream::where('id', $id) ->first();
       
        $pot_amount = Bet::where('game_id', $livestream->id)->sum('amount');
           
        $setting=Setting::find(1);// get setting 
        $game_name = "";
        $player_stats = null;

        if ($livestream) {
            //active
            $game_id = $livestream->id;
        } else {
            $game_id = 0;
        }

		$user = auth()->user();
        $uid = $user->id;

        //$active_bets = Bet::with('user')->where('game_id', $game_id)->limit(1)->orderBy('created_at', 'desc')->get();
        //$active_bets = BetMain::with('user')->where('game_id', $game_id)->limit(1)->orderBy('created_at', 'desc')->get();
        // $betting_masters = Betting::where('is_active', 1)->orderBy('betting_amount', 'asc')->get();
// $active_bets = DB::table("bet_main") 
// 		 ->select("bet_main.*","users.username",
// 		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id) as total"),
// 		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' ) as is_add_bet"),
// 		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' AND is_claimed  = 1  ) as is_claim_bet")
// 							 )
// 			 ->join('users', 'users.id', '=', 'bet_main.user_id')
// 			->where('livestream_id', $game_id)->orderBy('created_at', 'desc')->get();
            $betting_masters = Betting::where('is_active', 1)->orderBy('betting_amount', 'asc')->get();
            $active_bets = BetMain::with(['master','user','bets'])
            ->select("bet_main.*",
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id) as total"),
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' ) as is_add_bet"),
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id and user_id = '".$uid."' AND is_claimed  = 1  ) as is_claim_bet")
							 )
            ->where('livestream_id', $game_id)->orderBy('created_at', 'desc')->get();
	
            // dd($active_bets);
        $conversion = \DB::table('conversion')->first();

        // user label
       
        $count_label = 0;
        $chk_label = '';
        $count_bet = 0;
        $user_room_names = '';
        $current_room_names = '';
        $rm_name = '';
        $l_name = '';
        $label_name = '';
        $r = '';
$email=$uid;
        if ($email > 0) {
            //$uname = Users::select('Username', 'id')->where('Email', $email)->first();
            $uname = auth()->user();
			$user_id = $uname->id;

            $count_label = UserLabel::where('user_id', $user_id)->get()->count();
           $chk_label = UserLabel::where('user_id', $user_id)->get();

            $l_name = GameLabel::with('userlabel')->where('user_id', $user_id)
                ->where('game_id',  $livestream->id)->first();
           
            if ($l_name) {
                $label_name = $l_name->userlabel->label_game;
           }


            // room

            $user_id = $uname->id;

            if ($count_bet = Bet::where('user_id', $user_id)->count() > 0) {
                $chk_first_bet = Bet::select('user_id', 'id', 'game_id')->where('game_id', $game_id)->orderBy('id', 'asc')->limit(1)->first();
                if ($chk_first_bet != '') {
                    $bet_user_id = $chk_first_bet->user_id;
                } else {
                    $bet_user_id = 'empty';
                }


                if ($bet_user_id == $user_id) {

                    $count_game_room = GameRoom::select('user_id', 'game_id')->where('user_id', $user_id)
                        ->where('game_id',    $livestream->id)->count();


                    if ($count_game_room > 0) {
                        $user_room_names = UserRoom::select('id', 'room_name', 'user_id')->where('user_id', $user_id)->get();
                        $current_room_names = GameRoom::where('user_id', $user_id)->where('game_id', $livestream->id)->latest()->first();
                          
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
                    $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id', $livestream->id)->first();

                    if ($r != '') {
                        $rm_name = $r->game_room->room_name;
                        $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
                    } else {
                        $count_bet = 0;//no game id found on bet of this user so he only sees existing room name or anonymous
                    }
                }
            } else {
               $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id', $livestream->id)->first();
                if ($r != '') {
                    $rm_name = $r->game_room->room_name;
                    $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
                } else {
                    $count_bet = 0;
                }

            }
        } else {
            $r = GameRoom::with('game_room')->select('room_id', 'user_id')->where('game_id', $game_id)->first();
            if ($r != '') {
                $rm_name = $r->game_room->room_name;
                $count_bet = 3;// if no bet found of that user but room created alredy by another user of this game id;
            } else {
                $count_bet = 0;
            }

        }
         
        $viewer = $livestream->viewer()->where('users_id',auth()->user()->id)->first();
       if(!$viewer){
        $livestream->viewer()->attach(auth()->user()->id);
       }
       $setting = Setting::first();
 
      
        return view('live.show_stream',
            ['livestream' => $livestream,'pot_amount'=>$pot_amount, 'setting' => $setting,'game_name' => $game_name, 'player_stats' => $player_stats, 'active_bets' => $active_bets, 'betting_masters' => $betting_masters, 'conversion' => $conversion, 'count_label' => $count_label, 'chk_label' => $chk_label, 'label_name' => $label_name, 'l_name' => $l_name, 'count_bet' => $count_bet, 'email' => $email, 'user_room_names' => $user_room_names, 'current_room_names' => $current_room_names, 'rm_name' => $rm_name]);
    }
    

    public function filtes(){
        $filters = SpamWords::pluck('name')->toArray();

        return response()->json(['data'=> $filters],200);
    }
    public function delayTime(Request $request){
        $livestream = Livestream::find($request->id);
        if( $livestream){
            tap($livestream->update(['delay_time'=>$request->time]));
            broadcast(new ChatDelayEvent($livestream));
        }
        return response()->json(['success'=>true]);
    }

    public function onrmptStop(Request $request){

        // \Log::info("live stream stop from rmpt is working fine!");
        // \Log::info($request->all());
        \Log::info($request->name);
        $streamId = $request->name;
        $livestream = Livestream::where('stream_id', $streamId)
            ->first(); 
		 
			
            \Log::info( $livestream);
            if ($livestream) { 
				$stream_id_new=$livestream->stream_id.'1';
				
                tap($livestream)->update(['status'=> "stopped" , 'stream_id' => $stream_id_new]);
                \Log::info( $livestream);
                broadcast(new ChatDelayEvent($livestream));
    
            return response('Good', 200)->header('Content-Type', 'text/plain');
        }

        return response('No', 400)->header('Content-Type', 'text/plain');

    }

	public function renameStreamApi(Request $request){
		$streamId = $request->name;  
		$livestream = Livestream::where('stream_id', $streamId) ->first();
		 
		if($livestream) {
			return response()->json(['new_name'=> $livestream->id,'name'=> $streamId],200);
			  
		}else{
			
			$streamId = $request->name;  
			$streamIdn = $request->name.'1';  
			$livestreamn = Livestream::orderBy('id','desc')->where('stream_id', $streamIdn) ->first();
			if($livestreamn) {
				return response()->json(['new_name'=> $livestreamn->id,'name'=> $streamId],200);
			  
			}else{	
			
			 return response()->json([],400); 
			}
		}
		 
	}

}
