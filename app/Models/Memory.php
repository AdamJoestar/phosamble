<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
