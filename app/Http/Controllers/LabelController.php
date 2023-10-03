<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bet;
use Session;
use App\Models\UserLabel;
use App\Models\Users;
use App\Models\GameLabel;
use App\Models\GameRoom;
use App\Models\UserRoom;

class LabelController extends Controller
{
    //fresh label create
    public function submit_label(Request $request)
    {
        $request->validate([
            'user_label'=>'required'
        ]);
        $game_id = $request->game_id;
        //$email = Session::get('userid');
        //$uname = Users::select('id')->where('Email',$email)->first();
        $uname = auth()->user();
        $user_id = $uname->id;
        $label = new UserLabel();
        $label->label_game = $request->user_label;
        $label->user_id   =$user_id;
        $label->username = auth()->user()->username;
        if($label->save()) {
            $game_label = new GameLabel();
            $game_label->game_id = $game_id;
            $game_label->user_id = $user_id;
            $game_label->label_id = $label->id;
            $game_label->username = auth()->user()->username;

            if($game_label->save()) {
                return back()->with('success', 'Your Label added Successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Something went wrong');
        }

    }
    // update label
    public function update_label(Request $request)
    {

        //$email = Session::get('userid');
        //$uname = Users::select('id')->where('Email',$email)->first();
        $uname = auth()->user();
        $user_id = $uname->id;
        $game_id = $request->game_id;
        $label_game_name = $request->game_label;
        // return $label_game_name;
        $count_user = GameLabel::where('user_id', $user_id)->where('game_id', $game_id)->count();
        $game_lbl_id    = UserLabel::where('user_id', $user_id)->where('label_game', $label_game_name)->first();

        // return $count_user;
        if($count_user == 1 && $count_user > 0) {
            $delete = GameLabel::where('user_id', $user_id)->where('game_id', $game_id)->first();
            // return $delete;
            if($delete->delete() && $game_lbl_id) {

                // if(@$game_lbl_id->id){
                $label_id = $game_lbl_id->id;

                $upd = new GameLabel();
                $upd->user_id = $user_id;
                $upd->game_id = $game_id;
                $upd->label_id = $label_id;
                $upd->username = auth()->user()->username;

                if($upd->save()) {
                    return back()->with('success', 'Game Label Added Successfully!');
                } else {
                    return back()->with('error', 'Oops Something went wrong');
                }
                // }//if not delete;
            }
            // else
            // {
            // 		return back()->with('error','Label not Updated, Something went wrong please try after some time');
            // }

        } else {


            $label_id = $game_lbl_id->id;
            $upd = new GameLabel();
            $upd->user_id = $user_id;
            $upd->game_id = $game_id;
            $upd->label_id = $label_id;
            $upd->username = auth()->user()->username;

            if($upd->save()) {
                return back()->with('success', 'Game Label Added Successfully!');
            } else {
                return back()->with('error', 'Oops Something went wrong');
            }//if not delete;
        }
    }




    public function on_change_new_label_update(Request $request)
    {

        $game_id = $request->game_id;
        //$email = Session::get('userid');
        //$uname = Users::select('id')->where('Email',$email)->first();

        $uname = auth()->user();

        $user_id = $uname->id;


        $user_label =  new UserLabel();
        $user_label->user_id = $user_id;
        $user_label->username = $uname->username;
        $user_label->label_game = $request->onchange_label_name;

        $count = GameLabel::where('game_id', $game_id)->where('user_id', $user_id)->count();
        if($count > 0) {
            $del_lbl = GameLabel::where('game_id', $game_id)->where('user_id', $user_id)->delete();
            if($del_lbl) {
                if($user_label->save()) {
                    $game_label = new GameLabel();
                    $game_label->user_id = $user_id;
                    $game_label->game_id = $request->game_id;
                    $game_label->username = $uname->username;
                    $game_label->label_id = $user_label->id;

                    if($game_label->save()) {
                        return back()->with('success', 'Label added Successfully');
                    } else {
                        return back()->with('error', 'oops Something went wrong please try after some time');
                    }
                } else {
                    return back()->with('error', 'User not found');
                }
            } else {
                return back()->with('error', 'Oops Something went wrong Please try after some time deletion failed');
            }
        } else {
            if($user_label->save()) {
                $game_label = new GameLabel();
                $game_label->user_id = $user_id;
                $game_label->game_id = $request->game_id;
                $game_label->username = $uname->username;
                $game_label->label_id = $user_label->id;

                if($game_label->save()) {
                    return back()->with('success', 'Label added Successfully');
                } else {
                    return back()->with('error', 'oops Something went wrong not saved game label');
                }
            } else {
                return back()->with('error', 'Something went wrong try after some time not saved user label');
            }
        }

    }
}
