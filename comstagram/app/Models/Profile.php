<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'url'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/No_image_available.svg.png';
        return '/storage/' .  $imagePath;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
