<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
	// public $timestamps = false;  if not save date and time 
    protected $table='setting';
    protected $fillable =[
        'id',
        'vig',
        'extra_vig_division_factor',
        'streamer_per',
        'no_of_user_can_bet',
        'min_wallet_trasfer_amount',
        'client_id',
        'api_username',
        'api_password',
        'api_signature',
        'environment'
    ];
  
   
    
}
