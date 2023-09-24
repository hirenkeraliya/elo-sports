<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
use App\Models\Chat;
use App\Models\UserLivestreams;
use App\Models\Users;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class MessageController
{

      // this function will  fetch all the chat lists where livestream id is required
    public function lists($id)
    {
        // $chat = Chat::with(['user','user.livestreams'=>function($query)use($id){
        //   $query->where('livestreams_id',$id)->get();
        // }])->where(['livestreams_id' => $id])->orderBy('created_at', 'asc')->get();
        $chat = Chat::with(['user'])->where(['livestreams_id' => $id])->orderBy('created_at', 'asc')->get();
      
        $avatar = UserLivestreams::where(['livestreams_id' => $id])->where(['user_id' => auth()->user()->id])->first();
        $mychat = Chat::with(['user'])->where(['livestreams_id' => $id])->where('user_id', auth()->user()->id)->orderBy('created_at', 'asc')->count();
        $path = public_path() . '/avatar';
        $files = File::files($path);

        $avatars = [];
        foreach ($files as $key => $path) {
            $files = pathinfo($path);
            $avatars[] = [

                'id' => $key + 1,
                'src' => url('/avatar'.'/'. $files['basename']),
                'alt' => $files['basename']

            ];
        }

        return response()->json(['success' => true, 'data' => $chat, 'images' => $avatars, 'avatar' => $avatar, 'mychat' => $mychat]);

    }


    // this function will save the chat 
    public function broadcast(Request $request)
    {
       

        $data =[
            
            'file_type'=>'nullable',
            'message'=>'required_if:file_type,null',
            'file'=>'nullable|max:8000', 
        ];
         $validation =    Validator::make($request->all(),$data);
      
        if($validation->fails()) {
            return response()->json([$validation->errors()],422);
        }
        if (!$request->filled('message')) {
            return response()->json([
                'message' => 'No message to send'
            ], 422);
        }
        $user = auth()->user();
        if($request->hasFile('file')){
        $disk = Storage::disk('public');
          $file = $request->file('file');
          $filename = 'chat-' . time() . '.' . $file->getClientOriginalExtension();
          $file->move(storage_path('app/public/chat'), $filename);
          $datas['file_type'] = $request->file_type;
          $datas['file'] = 'chat/'.$filename;
        }
        $datas['user_id'] = $user->id;
        $datas['livestreams_id'] = $request->livestreams_id;
        $livestreamId = $request->livestreams_id;
        
        $datas['message'] = $request->message;
        $chat = Chat::create($datas);
        $output = Chat::with(['user'])->find($chat->id);
        // $output = ChatResource::collection( $chat );
        //this broadcasting is used to call the event for real time function 
        broadcast(new ChatEvent($request->message, $user, $output, $chat->createAt));
        return response()->json(['success' => true, 'data' => $output], 200);

    }

    // this function will lists all the users except the loing user who fetch it 
    public function userLists()
    {

        $userList = Users::whereNotIn('id', [auth()->user()->id])->get();
        $userLists = new UserResource($userList);
        // dd( $userLists);
        return response()->json(['success' => true, 'data' => $userLists], 200);
    }

}
