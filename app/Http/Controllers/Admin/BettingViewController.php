<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bettingview;
use Illuminate\Http\Request; 

class BettingViewController extends Controller
{
    //
	public function getBettingViewList(){ 
		   $records = Bettingview::paginate(10);
        return view('backend.bettingviewlist', compact('records'));
		
	}
	  public function editBettingView($id)
    {
        $bettingview = Bettingview::find($id);
        return view('backend.bettingviewadd', compact('bettingview'));
    }
	  public function add()
    { 
		$bettingview = optional();   // to send blank object 
        return view('backend.bettingviewadd', compact('bettingview'));
    }
	 
	public function updateBettingView(Request $request , $id ){
		
		$validator_data=$request->validate([
		'no_of_views'	=> 'required|integer' , // validare function		
		'no_of_bet'		=> 'required|integer'  // validare function		
		],
		[
		'no_of_views.required'=>'No of views  required',
		'no_of_views.integer'=>'No of views  must be numberic',
		'no_of_bet.required'=>'No of bets  required',
		'no_of_bet.integer'=>'No of bets  must be numberic '
		]
		);
		 
		$bettingview=Bettingview::find($id);// get  
        $bettingview->no_of_views = $request->input('no_of_views');  
        $bettingview->no_of_bet = $request->input('no_of_bet');  
        $bettingview->save();
        return redirect('bettingview/list')->with('status','Record Updated Successfully');
	}
	
	
	public function saveBettingView(Request $request  ){
		
		$validator_data=$request->validate([
		'no_of_views'	=> 'required|integer' , // validare function		
		'no_of_bet'		=> 'required|integer'  // validare function		
		],
		[
		'no_of_views.required'=>'No of views  required',
		'no_of_views.integer'=>'No of views  must be numberic',
		'no_of_bet.required'=>'No of bets  required',
		'no_of_bet.integer'=>'No of bets  must be numberic '
		]
		);
		   
		$bettingview=new  Bettingview ;// get  
        $bettingview->no_of_views = $request->input('no_of_views');  
        $bettingview->no_of_bet = $request->input('no_of_bet');  
        $bettingview->save();
        return redirect('bettingview/list')->with('status','Record saved Successfully');
	}
	
	public function destroy($id)
    {
        $bettingview = Bettingview::find($id);
        $bettingview->delete();
        return redirect()->back()->with('status','Record Deleted Successfully');
    }
}
