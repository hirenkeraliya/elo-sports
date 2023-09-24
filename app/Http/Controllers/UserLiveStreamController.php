<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Chat;
use App\Models\Livestream;
use App\Models\UserLivestreams;
use Illuminate\Http\Request;
use Validator;

class UserLiveStreamController extends Controller
{
    


    public function index($id){

        $chat = Chat::where('user_id',auth()->user()->id)->where('livestreams_id',$id)->first();
        $avatar = UserLivestreams::where('user_id',auth()->user()->id)->where('livestreams_id',$id)->first();
        return response()->json(['success'=>true,'data'=>$chat,'avatar'=>$avatar]);
    }

    public function store(Request $request){

        if($request->hasFile('avatar_image')){
            $data =[
                'avatar_image'=>'required|image',
            ];
        }else{
            $data =[
                'avatar_image'=>'required',
            ];
        }
        

      $validation =    Validator::make($request->all(),$data);
      if ($validation->passes()) {

        $data = $request->except(['_token','livestreams_id']);

        $strem = Livestream::find($request->livestreams_id);
      
       $user = auth()->user();
        $message['user_id'] = $request->user_id;
        $message['livestreams_id'] = $request->livestreams_id;
        if($request->hasFile('avatar_image')){
            $imageName = time() . '.' . $request->avatar_image->extension();
            $request->avatar_image->move(public_path('avatar-images'), $imageName);
            $message['avatar_image'] = url('/'.'avatar-images/'.$imageName);
        }else{
            $message['avatar_image'] =$request->avatar_image;
        }
        $old = UserLivestreams::where('user_id',$user->id)->where('livestreams_id',$request->livestreams_id)->first();
        if(!$old){
            $avatar = UserLivestreams::create($message);
        }else{
            $avatar = tap($old)->update($message);
        }
   
        return response()->json(['success' => true,'data'=>  $avatar->avata_image], 200);
    }
    return response()->json(['error'=>$validation->errors()], 422);

    }
}
