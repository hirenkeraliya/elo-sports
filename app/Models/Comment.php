<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // livestream
    public function livestream(): BelongsTo
    {
        return $this->belongsTo(Livestream::class);
    }

}
