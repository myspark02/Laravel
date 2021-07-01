<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cover_image() {
        return $this->cover_image ? $this->cover_image: 'no_img_available.png';
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
