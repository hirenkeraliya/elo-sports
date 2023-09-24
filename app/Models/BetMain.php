<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BetMain extends Model
{
    use HasFactory;

    protected $guarded = [];
	// public $timestamps = false;  if not save date and time 
    protected $table='bet_main';
    protected $fillable =[
        'id',
        'master_betting_id',
        'betting_amount',
        'for_text',
        'against_text',
        'description',
        'user_id',
        'livestream_id',
        'is_declared_result',
        'declaration_date',
        'declaration_by',
        'won_side',
        'streamer_fee'
        
    ];
     // this function is this bets belongs to the particular betting master
    public function master(){
        return $this->belongsTo(Betting::class,'master_betting_id');
    }
     // this function is this bets belongs to the particular users
   public function user()
    {
        return $this->BelongsTo('App\Models\Users','user_id','id');
    }
	 // this function is this bets belongs to the particular streams
	 public function stream()
    {
        return $this->BelongsTo('App\Models\Livestream','game_id','id');
    }
     // this function indicates that this bet main have number of bets
    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    // this function is used to fetch the fidderence hours it menas this bets main is 2 hour 36min 45 sec ago created
    public function getCreatedDiffAttribute(){
        $createdAt =  $this->attributes['created_at'];
        $current =  Carbon::parse(Carbon::now());
        $diffInSeconds = $current->diffInSeconds($createdAt);
        $hours = floor($diffInSeconds / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        $seconds = $diffInSeconds % 60;
        return "{$hours} hours {$minutes} mins {$seconds} sec";

    }
    
}
