<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['caption', 'image', 'user_id'];

    public function getImageAttribute($value) {
        return '/storage/'.$value;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
