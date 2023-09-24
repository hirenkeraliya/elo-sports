<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameLabel extends Model
{
    use HasFactory;
    protected $table= 'game_label';

    protected $guarded = [];

    public function userlabel()
    {
        return $this->BelongsTo('App\Models\UserLabel','label_id','id');
    }
}
