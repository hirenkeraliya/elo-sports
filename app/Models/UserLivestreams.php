<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLivestreams extends Model
{
    use HasFactory;

    protected $table='user_livestream_details';
    protected $fillable =[
        'avatar_image',
        'avatar_username',
        'user_id',
        'livestreams_id'
    ];



    // this function will show the users who belong to this live streams
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // this function will show thes livestreams
    public function livestream(){
        return $this->belongsTo(Livestream::class,'livestreams_id');
    }
}
