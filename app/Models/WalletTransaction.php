<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];
	// public $timestamps = false;  if not save date and time 
    protected $table='wallet_transaction';
    protected $fillable =[
        'id',
        'user_id',
        'bet_main_id',
        'bet_id',
        'game_id',
        'win_side',
        'transaction_type',
        'transaction_amount', 
        'comment',
        'email_id',
    ]; 
    
}
