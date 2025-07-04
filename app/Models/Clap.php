<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clap extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];
 
    public const UPDATED_AT = null; // No updated_at column

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
