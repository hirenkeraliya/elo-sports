<?php
 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request; 
use App\Models\BetMain;
use App\Models\Livestream;
use App\Models\Setting;
use App\Models\Bet;
use App\Models\WalletTransaction;

use Illuminate\Support\Facades\DB;
class MyBetsController extends Controller
{
   
 
	public function getMyBettingList(){ 
			$user_id=auth()->user()->id;  
			  $records = Bet::with(['betmain','livestreams'])->where('user_id', $user_id)->orderBy('id', 'desc')->paginate(10); 
		    return view('MyBets.index',  ['records' => $records  ]);
			
		}
	 
	 
	 public function getMyTransactionList(){ 
		$user_id=auth()->user()->id;  
			  $records = WalletTransaction::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(10); 
		
		 
				return view('MyTranscation.index',  ['records' => $records  ]);
			
		}
	 
 
 }
