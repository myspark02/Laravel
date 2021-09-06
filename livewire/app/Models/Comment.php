<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;

    public $guarded = [];

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function getImagePathAttribute()
    {
        return  'storage/images/'.$this->image;
    }
}
