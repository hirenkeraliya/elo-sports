<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Betting;
use Illuminate\Http\Request; 

class BettingController extends Controller
{
    //
	public function getBettingList(){ 
		   $records = Betting::where('added_by', 1)->orderBy('created_at','desc')->paginate(10);
        return view('backend.bettinglist', compact('records'));
		
	}
	  public function editBetting($id)
    {
        $betting = Betting::find($id);
        return view('backend.bettingadd', compact('betting'));
    }
	  public function add()
    { 
		$betting = optional();   // to send blank object 
        return view('backend.bettingadd', compact('betting'));
    }
	 
	public function updateBetting(Request $request , $id ){
		
		$validator_data=$request->validate([
		'betting_amount'	=> 'required|decimal:0,2' , // validare function		
		'description'		=> 'required|max:255'  // validare function		
		],
		[
		'betting_amount.required'=>'Billing amount required',
		'betting_amount.decimal'=>'Billing amount must be numberic',
		'description.required'=>'Description required',
		'description.max'=>'Description required maximum 255 character ' 
		]
		);
		 
		$betting=Betting::find($id);// get  
        $betting->betting_amount = $request->input('betting_amount');  
        $betting->description = $request->input('description');  
        $betting->save();
        return redirect('betting/list')->with('status','Record Updated Successfully');
	}
	
	
	public function saveBetting(Request $request  ){
		
		$validator_data=$request->validate([
		'betting_amount'	=> 'required|decimal:0,2' , // validare function		
		'description'		=> 'required|max:255'  // validare function		
		],
		[
		'betting_amount.required'=>'Billing amount required',
		'betting_amount.decimal'=>'Billing amount must be numberic',
		'description.required'=>'Description required',
		'description.max'=>'Description required maximum 255 character '
		]
		);
		   
		$betting=new  Betting ;// get  
        $betting->betting_amount = $request->input('betting_amount');  
        $betting->description = $request->input('description');  
        $betting->save();
        return redirect('betting/list')->with('status','Record saved Successfully');
	}
	
	public function destroy($id)
    {
        $betting = Betting::find($id);
        $betting->delete();
        return redirect()->back()->with('status','Record Deleted Successfully');
    }
}
