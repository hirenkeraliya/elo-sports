<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livestream extends Model
{
    use HasFactory;

    protected $guarded = [];

    // user
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    protected $fillable = [
        'user_id',
        'stream_id',
        'name',
        'image',
        'status',
        'description',
        'delay_time',
        'view_counter',
        'type'
    ];
    public $appends = ['fileLink'];
    // comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // this live streams has many cahts
    public function chats()
    {
        return $this->hasMany(Chat::class, 'livestreams_id');
    }

    public function getFileLinkAttribute()
    {
        $url ="http://".config('app.ip_address')."/'.$this->stream_id.'.mp4";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }

    // this function will show the livestream that  who can monitor this livestream
    public function whomonitor()
    {
        return $this->belongsToMany(Users::class, 'livestream_monitor');
    }
    // this function will fetch the total viewer of this live streams
    public function viewer()
    {
        return $this->belongsToMany(Users::class, 'livestream_count');
    }
    // this function will shows the number of bets has many bets
    public function bets()
    {
        return $this->hasMany(Bet::class, 'game_id', 'id');
    }
    // this function tell that this livestreams has many bet main
    public function betMain()
    {
        return $this->hasMany(BetMain::class, 'livestream_id', 'id');
    }




}
