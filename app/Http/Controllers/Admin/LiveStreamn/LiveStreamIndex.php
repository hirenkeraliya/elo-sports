<?php

namespace App\Http\Controllers\Admin\LiveStreamn;

use App\Http\Controllers\Controller;
use App\Models\Livestream;
use App\Models\Setting;
use App\Models\Users;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class LiveStreamIndex extends Controller
{
    
  // this function will lists all the live streas 
    public function index($type){
		 			 
            if (request()->ajax()) {
            
               ($type == 'completed') ?  $status = ['stopped'] : $status = ['started','created'];
               
               if(auth()->user()->can('view-livestream-watcher')){
                  $livestreams = Livestream::whereHas('whomonitor',function($q){
                     $q->where('user_id',auth()->user()->id);
                  })->with('user')->orderBy('created_at','desc')
                  ->whereIn('status',  $status)->get();
               }else{
				   
                  if( $status[0] == 'stopped'){
                  
					
					$livestreams_one = Livestream::with('user')->whereNull('type')->orderBy('created_at','desc')
                    ->whereIn('status',  $status);
				     $livestreams = Livestream::has('bets')->with('user')->orderBy('created_at','desc')
                     ->whereIn('status',  $status)->where('type','twitch')->unionAll($livestreams_one)->get();
					
                     // $livestreams = Livestream::with('user')->orderBy('created_at','desc')
                     // ->whereIn('status',  $status)->get();
					
					 
                  }else{
                  
					 
					$livestreams_one = Livestream::with('user')->whereNull('type')->orderBy('created_at','desc')
                    ->whereIn('status',  $status);
				     $livestreams = Livestream::has('bets')->with('user')->orderBy('created_at','desc')
                     ->whereIn('status',  $status)->where('type','twitch')->unionAll($livestreams_one)->get();
					 
                     // $livestreams = Livestream::with('user')->orderBy('created_at','desc')
                     // ->whereIn('status',  $status)->get();
                  }
               }

            
               return DataTables::of($livestreams)
               ->addIndexColumn()
                    ->addColumn('email',function($q){
                     return $q->user ? $q->user->email : Null;
                    })
                    ->addColumn('type',function($q){
                     if(is_null($q->type)){
                        
                        $type ='Elo';
                     }else{
                       
                        $type ='Twitch';

                     }
                     return $type;
                    })
                    ->addColumn('username',function($q){
                     return $q->user ? $q->user->username : Null;
                  })
                    
                    ->editColumn('created_at', function ($row) {
                       return $row->created_at->format('Y-m-d H:i:s A');
                    })
                    ->editColumn('updated_at', function ($row) {
                     return $row->updated_at->format('Y-m-d H:i:s A');
                  })
                    ->addColumn('action',function($row) use($type){
                      $btn ='<div class="dropdown">';
                      $btn .='<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>';
                      $btn .='<ul class="dropdown-menu">';
                    
                      if(auth()->user()->can('view-live-streaming')){
						 /* $url=env('RMPT_STREAMING_URL').'/'.$row->id.'.mp4'; 
                        if(str_contains(get_headers($url)[0], "200 OK")){
							$btn .='<li><a href="'.((is_null($row->type)) ? url('stream/'.$row->id) : url('streams/show/'.$row->id)).'" class="anchor-link" target="_blank"> Visit </a></li>';
                      
						}else{
						
							 $btn .='<li><a href="javascript:void(0);" class="anchor-link"  > Recording Not Available '.$row->id.' </a></li>';
                      
						 }  */
						if($row->type=='twitch'){
						$btn .='<li><a href="'.((is_null($row->type)) ? url('stream/'.$row->id) : url('streams/show/'.$row->id)).'" class="anchor-link" target="_blank"> Visit </a></li>';
						}else{
						$btn .='<li><a href="'.((is_null($row->type)) ? url('stream/'.$row->id) : url('streams/show/'.$row->id)).'" class="anchor-link" target="_blank"> Visit </a></li>';
							
						}
						}
                      if(auth()->user()->can('view-bet')){
                        $btn .='<li><a href="'.url('report/active_bet_list/'.$row->id).'" class="anchor-link" target="_blank"> View Bet </a></li>';
                      }
                     if($row->chats()->count() > 0){
                        if(auth()->user()->can('view-chat')){
                        $btn .=' <li><a href="'.url('chat-lists?livestream_id='.$row->id).'" class="anchor-link" target="_blank">Chat</a></li>';
                        }
                     }
                    if($type == 'in-progress'){
                     if(auth()->user()->can('create-delay-time')){
                     $btn .='<li> <a href="javascrip:void(0)" data-id="'.$row->id.'" data-time="'.$row->delay_time.'" class="anchor-link delay_moal"> Add Delay</a></li>';
                     }  
                  }
                  if(auth()->user()->can('delete-live-streaming')){
                  //   $btn .=' <li><a href="javascript:void(0)" data-id="'.$row->id.'" class="anchor-link live-delete" >Delete</a></li>';
                  }
                    $btn .='</ul></div>';
                      return $btn;
                    })
                    ->rawColumns(['action','username','email','type'])
                    ->make(true);
                  }
      
      //      if(request()->has('orderBy')){
      //       $livestreams->appends(['orderBy' => request()->get('orderBy')]);
      //      }
            
            return view('backend.livestreams.index');
    }

   
   // this function will delete the livestreams 
   public function destroy(Request $request){
     
     $id = $request->id;
      if($id){
         $livestrem = Livestream::find($id);
         $livestrem->delete();
         return response()->json(['success'=>true],200);
      }
      return response()->json(['success'=>false],404);
   }

   // this function will show the  users livestream bets profit and loss
   public function showReport(){

    

      if (request()->ajax()) {
        if(request()->has('start_date')){
         $start = Carbon::parse(request()->start_date)->format('Y-m-d');
     
         $end = Carbon::parse(request()->end_date)->format('Y-m-d');
        
         $users =  Users::whereHas('streams', function($query) use ( $start,$end) {
            $query->whereBetween('created_at', [$start,$end]);
        })->with(['streams' => function($query) use ($start,$end) {
            $query->whereBetween('created_at', [$start,$end])->withCount('bets')->withSum('bets','amount')->withSum('bets','vig_amount');
        },'streams.bets'])->get();
        }else{
         $today = Carbon::today();
         $users =  Users::whereHas('streams', function($query) use ($today) {
           $query->whereDate('created_at', $today);
       })->with(['streams' => function($query) use ($today) {
           $query->whereDate('created_at', $today)->withCount('bets')->withSum('bets','amount')->withSum('bets','vig_amount');
       },'streams.bets'])->get();
        }
       
     $setting= Setting::find(1);
     return DataTables::of($users)
     ->addIndexColumn()
          ->addColumn('streamer_name',function($q){
            return $q->username;
          })
          ->addColumn('total_stream',function($q){
            return $q->streams->count();
         })
          ->addColumn('total_bet_count',function($q){
            return $q->streams->sum('bets_count');
         })
         ->addColumn('total_amount',function($q){
            return $q->streams->sum('bets_sum_amount');
         })
         ->addColumn('total_vig_amount',function($q){
            return $q->streams->sum('bets_sum_vig_amount');
         })
         ->addColumn('streamer_fee',function($q){
            $setting= Setting::find(1);
            return round(($q->streams->sum('bets_sum_vig_amount')*$setting->streamer_per)/100);
         })
         ->addColumn('profit',function($q){
            $setting= Setting::find(1);
            return round(($q->streams->sum('bets_sum_vig_amount') -  ($q->streams->sum('bets_sum_vig_amount')*$setting->streamer_per)/100));
         })
          ->rawColumns(['streamer_name','total_stream','total_bet_count','total_amount','total_vig_amount','streamer_fee','profit'])
         ->make(true);

       
        
        


   }
      // return view('backend.livestreams.report',['users'=>$users,'setting'=>$setting]);

      return view('backend.livestreams.report');
   }

   // this function will show twitch streams reports
   public function show_twitch_report(Request $request){
      if (request()->ajax()) {
         if(request()->has('start_date')){
          $start = Carbon::parse(request()->start_date)->format('Y-m-d');
      
          $end = Carbon::parse(request()->end_date)->format('Y-m-d');
        
          $users =  Livestream::where('type','twitch')->whereBetween('created_at', [$start,$end])->with(['bets'])->get();
         }else{
            $today = Carbon::today();
          $users =  Livestream::where('type','twitch')->whereDate('created_at',$today)->with(['bets'])->get();
         
         }
        
      $setting= Setting::find(1);
      return DataTables::of($users)
      ->addIndexColumn()
          ->addColumn('stream_name',function($q){
             return $q->name;
           })
          
           ->addColumn('total_bet_count',function($q){
             return $q->bets()->count();
          })
          ->addColumn('total_amount',function($q){
             return $q->bets()->sum('amount');
          })
          ->addColumn('total_vig_amount',function($q){
             return $q->bets()->sum('vig_amount');
          })
          ->addColumn('streamer_fee',function($q){
             $setting= Setting::find(1);
             return round(($q->bets()->sum('vig_amount')*$setting->streamer_per)/100);
          })
          ->addColumn('profit',function($q){
             $setting= Setting::find(1);
             return round(($q->bets()->sum('vig_amount') -  ($q->bets()->sum('vig_amount')*$setting->streamer_per)/100));
          })
           ->rawColumns(['stream_name','total_bet_count','total_amount','total_vig_amount','streamer_fee','profit'])
          ->make(true);
 
   }
   return view('backend.livestreams.twitch_report');
}

   public function searchReport(Request $request){
      $start = Carbon::parse($request->start_date)->format('Y-m-d');
     
      $end = Carbon::parse($request->end_date)->format('Y-m-d');
     
      $users =  Users::whereHas('streams', function($query) use ( $start,$end) {
         $query->whereBetween('created_at', [$start,$end]);
     })->with(['streams' => function($query) use ($start,$end) {
         $query->whereBetween('created_at', [$start,$end])->withCount('bets')->withSum('bets','amount')->withSum('bets','vig_amount');
     },'streams.bets'])->get();
     $setting= Setting::find(1);
     $view = view('backend.livestreams.table', [
      'users' => $users,
      'setting'=>$setting
  ])->render();
   return response()->json(['view'=>$view]);

   }
}
