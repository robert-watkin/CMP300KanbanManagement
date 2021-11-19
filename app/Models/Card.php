<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }

    public function cardMembers()
    {
        return $this->hasMany(CardMember::class);
    }

    public function checklist()
    {
        return $this->hasMany(CheckListItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
