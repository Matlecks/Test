<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }
}
