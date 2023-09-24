<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table='chat';
    protected $fillable =[
        'livestreams_id',
        'user_id',
        'message',
        'file',
        'file_type'
    ];

    public $appends =['createAt','avatars','link'];

     // this function is this bets belongs to the particular users
    public function user(){
        return $this->belongsTo(Users::class,'user_id');
    }
    // this function wil create the date format 
    public function  getcreateAtAttribute(){
           if(date('Y') == $this->created_at->format('Y')){
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('g:i A M d');
           }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y M d g:i A');
    }
     // this function is this bets belongs to the particular users livestreamming 
    public function userStraming(){
        return $this->belongsTo(UserLivestreams::class,'user_id','livestreams_id');
    }
     // this function is this bets belongs to the particular users
    public function getAvatarsAttribute(){
        return $this->user->livestreams()->where('livestreams_id',$this->livestreams_id)->get();
    }
     // this function is this used to the link for the file sotrage 
    public function getLinkAttribute(){
        return url('storage/');
    }

   
    
}
