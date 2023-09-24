<?php

namespace App\Models;

use App\Trait\HasPermissionsTrait;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable implements FilamentUser
{
    use HasFactory, HasApiTokens, Notifiable;
    use  HasPermissionsTrait;

    protected $guarded = [];

    public $appends = ['imageLink','name'];


    // this function will make image_link column for the fetching
    public function getimageLinkAttribute()
    {

        if ($this->profile && file_exists(public_path('images/' . $this->profile))) {
            return url('images/' . $this->profile);
        }
        return 'https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg';
    }

    // this users has many live streasm  users details
    public function livestreams()
    {
        return $this->hasMany(UserLivestreams::class, 'user_id');
    }

    // this function will show the numer of livestreams
    public function streams(){
        return $this->hasMany(Livestream::class,'user_id','id');
    }
    // public function getavatarsAttribute()
    // {
    //     return $this->livestreamAvatar->avatar_image ?? '';
    // }
   
// this function will creaete a column name
    public function getnameAttribute()
    {
        return $this->username;
    }

    // public function getavatarsAttribute()
    // {
    //     return $this->imageLink;
    // }

    public function canAccessFilament(): bool
    {
        return $this->email == 'admin@gmail.com';
    }
    // this function will shows all the livestream that this user can monitor
    public function canmonitor(){
        return $this->belongsToMany(Livestream::class,'livestream_monitor');
    }
    public function startStream(){
        return $this->canmonitor()->where('status','started');
    }
   

}
