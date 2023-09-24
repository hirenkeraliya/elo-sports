<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRoom extends Model
{
    use HasFactory;
    protected $table = 'game_room';

   

    protected $guarded = [];

   
    protected $fillable =[
        'user_id',
        'game_id',
        'room_id',
        'username',
    ];
    public function game_room()
    {
        return $this->BelongsTo('App\Models\UserRoom','room_id','id');
    }
}
