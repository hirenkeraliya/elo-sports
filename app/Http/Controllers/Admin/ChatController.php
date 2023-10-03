<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Livestream;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
    // this function will lists rhe chat of particular live streams

    public function index()
    {
        $id = request()->get('livestream_id');
        $streams = Livestream::find($id);
        if($streams) {
            if(request()->ajax()) {
                $start = Carbon::parse(request()->start_date)->format('Y-m-d H:i:s');
                $end = Carbon::parse(request()->end_date)->format('Y-m-d H:i:s');
                $chats = Chat::with(['user'])->where(['livestreams_id' => $id])->whereBetween('created_at', [$start, $end])->orderBy('created_at', 'desc')->get();

                $returnHTML = view('backend.chat.list')->with(['chats'=>$chats,'streams'=>$streams])->render();
                return response()->json(['success' => true, 'html'=>$returnHTML], 200);
            }
            $chats = Chat::with(['user'])->where(['livestreams_id' => $id])->orderBy('created_at', 'desc')->get();

            return view('backend.chat.chat')->with(['chats'=>$chats,'streams'=>$streams]);
        }
        return view('backend.chat.chat')->with(['chats'=>'']);
    }
}
