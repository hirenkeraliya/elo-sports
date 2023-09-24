<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpamWords extends Model
{
    use HasFactory;

    protected $table='spam_word';
    protected $fillable =[
        'name'
    ];
}
