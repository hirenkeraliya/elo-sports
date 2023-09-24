<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request; 
use App\Models\BetMain;
use App\Models\Livestream;
use App\Models\Setting;
use App\Models\Bet;

use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    //
	public function getActiveBetList($id){  
			$stram_info = Livestream::find($id);
			
			// $records = DB::table('notices')select("SELECT bm.*, u.username ,  ( select count(b.id)  from bets as b  where bet_main_id =  bm.master_betting_id) as total  ,  ( select count(b.id)  from bets as b  where bet_main_id =  bm.master_betting_id and bet_on ='for') as for_total  ,  ( select count(b.id)  from bets as b  where bet_main_id =  bm.master_betting_id and  bet_on ='against' ) as against_total     FROM `bet_main` as bm  ,  users  as u where game_id =  '".$id."' and u.id= bm.user_id;") ; 
		 //  $records = BetMain::with('bet')->where('game_id', $id)->paginate(10); 
		  $setting=Setting::find(1);// get setting 	
		  
		  
		  $records = DB::table("bet_main") 
		 ->select("bet_main.*","users.username",
		                     DB::raw("( select count(bets.id)  from bets  where bets.bet_main_id =  bet_main.id) as total"),
		                     DB::raw("( select count(bets.id)  from bets   where bet_main_id =  bet_main.id and bet_on ='for') as for_total"),
		                     DB::raw("( select count(bets.id)  from bets    where bet_main_id =  bet_main.id and  bet_on ='against' ) as against_total"))
			 ->join('users', 'users.id', '=', 'bet_main.user_id')
			->where('livestream_id', $id)->orderBy('created_at','desc')->paginate(10);  
	 


			return view('backend.report.activebetlist',  ['records' => $records,'stram_info'=>$stram_info,'setting'=>$setting]);
		
	}
 
 
 public function getBetterList($id){  
			$bet_info = BetMain::with('bets')->find($id);
			$stram_info = Livestream::find($bet_info->livestream_id);
		  $records = Bet::with('user')->where('bet_main_id', $id)->orderBy('created_at','desc')->paginate(10); 
		   
			return view('backend.report.betterlist',  ['records' => $records,'stram_info'=>$stram_info,'bet_info'=>$bet_info]);
		
	}
 
 }
