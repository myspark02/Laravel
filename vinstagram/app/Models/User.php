<?php

namespace App\Models;

use App\Events\NewUserRegisteredEvent;
use App\Jobs\SendWelcomeEmail;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    protected $with = ['profile', 'following'];

    public function likes()
    {
        return $this->belongsToMany(Post::class);
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
                'description' => 'No description',
            ]);

            // Mail::to($user->email)->send(new NewUserWelcomeMail($user));
            // 가능하면 Controller에서 이벤트를 발생시키면 좋다. 그래야 이벤트가 어디서 발생하는지
            // 쉽게 찾을 수 있기 때문이다.
            // event(new NewUserRegisteredEvent($user));
            // NewUserRegisteredEvent::dispatch();

            dispatch(new SendWelcomeEmail($user));
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
