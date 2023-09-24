<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;
    protected $table = 'bets';

    protected $guarded = [];


    // this function is this bets belongs to the particular users
    public function user()
    {
        return $this->BelongsTo('App\Models\Users','user_id','id');
    }
     // this function is this bets belongs to the particular betmain
	public function betmain()
    {
        return $this->BelongsTo('App\Models\BetMain','bet_main_id','id');
    }
     // this function is this bets belongs to the particular livestream
	public function livestreams()
    {
        return $this->BelongsTo('App\Models\Livestream','game_id','id');
    }
}
