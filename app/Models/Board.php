<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

class Board extends Model
{
    protected $fillable = ['title', 'code', 'user_id'];

    protected static function booted()
    {
        static::creating(function ($board) {
            Log::info('Creating board with attributes: ', $board->getAttributes());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function memories()
    {
        return $this->hasMany(Memory::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'board_user')->withTimestamps();
    }
}
