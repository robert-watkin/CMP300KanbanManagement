<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(BoardMember::class);
    }

    public function buckets()
    {
        return $this->hasMany(Bucket::class);
    }
}
