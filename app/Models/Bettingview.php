<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bettingview extends Model
{
    use HasFactory;

    protected $guarded = [];
	// public $timestamps = false;  if not save date and time 
    protected $table='betting_view_master';
    protected $fillable =[
        'id',
        'no_of_views',
        'no_of_bet',
        'created_at',
        'updated_at'
    ];
  
   
    
}
