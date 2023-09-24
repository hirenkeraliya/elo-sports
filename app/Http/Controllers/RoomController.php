<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Users;
use App\Models\UserRoom;
use App\Models\GameRoom;
use App\Models\Livestream;

class RoomController extends Controller
{
    // room submit
    public function submit_room(request $request)
    {
        
        $request->validate([
            'room_name'=>'required'
        ]);

        //$email = Session::get('userid');
        //$user = Users::select('id')->where('Email',$email)->first();
        $user = auth()->user();
        $user_id = $user->id;
        $user_room =  new UserRoom;
        $user_room->user_id = $user_id;
        $user_room->room_name = $request->room_name;
        $user_room->username = $user->username;
        if($user_room->save())
        {
            $game_room = new GameRoom;
            $game_room->user_id = $user_id;
            $game_room->game_id = $request->livestream_id;
           $game_room->room_id = $user_room->id;
            $game_room->username = $user->username;
            if($game_room->save())
            {
                return back()->with('success','Room added Successfully');
            }
            else{
                return back()->with('error','oops Something went wrong');
            }
        }
        else{
            return back()->with('error','Something went wrong try after some time');
        }


    }

    public function update_room(request $request)
    {
        
        $room_id  = $request->change_room;
        $game_id  =  $request->game_id;
        //$email = Session::get('userid');
        //$u = Users::where('Email',$email)->first();
		$u = auth()->user();
        $user_id = $u->id;
        $gameroom = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->where('room_id', $room_id)->first();
    
        if($gameroom){
            // $gameroom = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->where('room_id', $room_id)->delete();
            
            GameRoom::create([
            'user_id' => $user_id,
                'game_id' => $game_id,
               'room_id' => $room_id,
                'username' => $u->username
            ]);
       }else{
        $data=[
            'user_id' => $user_id,
                'game_id' => $game_id,
                'room_id' => $room_id,
                'username' => $u->username
        ];
        $gameroom = GameRoom::create($data);
        // $gameroom->update(['room_id'=>$room_id]);
        

       }
       if( $gameroom)
        {
                    return back()->with('success','Room Name Updated successfully');
         }else{
                    return back()->with('error','Oops Something went wrong Please try after some time');
        }
            // $add = new GameRoom;
            // $add->user_id = $user_id;
            // $add->game_id = $game_id;
            // // $add->room_id = $room_id;
            // $add->username = $u->username;

        // $count = $roomdata = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->count();
        // if($count > 0)
        // {
        //     $roomdata = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->delete();
        //     if($roomdata)
        //     {
        //         if($add->save())
        //         {
        //             return back()->with('success','Room Name Updated successfully');
        //         }else{
        //             return back()->with('error','Oops Something went wrong Please try after some time');
        //         }
        //     }
        //     else{
        //         return back()->with('error','Oops Something went wrong Please try after some time');
        //     }
        // }
        // else{
        //     if($add->save())
        //     {
        //         return back()->with('success','Room Name Updated successfully');
        //     }
        //     else
        //     {
        //         return back()->with('error','Oops Something went wrong Please try after some time');
        //     }
        // }
       
    }

   
    public function on_change_new_room_update(Request $request)
    {
        
        // dd($request->all(),1);
        $user_id = $request->user_id;
        $game_id  =  $request->game_id;
        $livestream = Livestream::find($game_id);
        $room_id  = $request->room_id;

        if(!strlen($user_id)){
          //  $email = Session::get('userid');
		 //   $user = Users::select('user_id')->where('Email',$email)->first();
			$user = auth()->user();
        $user_id = $user->id;
        }

        // object and adding common data;
        $user_room =  new UserRoom;
        $user_room->user_id = $user_id;
        $user_room->room_name = $request->room_name;
        $user_room->username = $user->username;
        $user_room->save();
        
        // $count = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->where('room_id',$room_id)->count();
      
         $first = GameRoom::where('game_id', $livestream->id)->where('user_id',$user_id)->where('room_id',$room_id)->first();
     
        if($first)
        {
            
           $done = $first->update([
                'user_id' => $user_id,
                'game_id' =>  $livestream->id,
                'room_id' =>  $user_room->id,
                'username' => $user->username,
            ]);
            if($done)
                    {
                        return back()->with('success','Room added Successfully');
                    }
                    else{
                        return back()->with('error','oops Something went wrong');
                    }
            // $roomdata = GameRoom::where('game_id',$game_id)->where('user_id',$user_id)->where('room_id',$room_id)->delete();
            // if($roomdata)
            // {
            //     if($user_room->save())
            //     {
            //         $game_room = new GameRoom;
            //         $game_room->user_id = $user_id;
            //         $game_room->game_id = $request->game_id;
            //         $game_room->room_id =  $request->room_id;
            //         $game_room->username = $user->username;
            //         if($game_room->save())
            //         {
            //             return back()->with('success','Room added Successfully');
            //         }
            //         else{
            //             return back()->with('error','oops Something went wrong');
            //         }
            //     }
            //     else{
            //         return back()->with('error','Something went wrong try after some time');
            //     }
            // }
            // else{
            //     return back()->with('error','Oops Something went wrong Please try after some time');
            // } 
        }
        else
        {
            if($user_room->save())
            {
                $game_room = new GameRoom;
                $game_room->user_id = $user_id;
                $game_room->game_id =  $livestream->id;
                 $game_room->room_id =  $user_room->id;
                $game_room->username =$user->username;
                if($game_room->save())
                {
                    // $game_room->update(['room_id'=>$user_room->id]);
                    return back()->with('success','Room added Successfully');
                }
                else{
                    return back()->with('error','oops Something went wrong');
                }
            }
            else{
                return back()->with('error','Something went wrong try after some time');
            }
        }
        
    }
}
