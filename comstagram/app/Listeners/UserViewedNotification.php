<?php

namespace App\Listeners;

use App\Events\UserLogined;
use App\Events\UserViewed;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserViewedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     *
     * @param  UserLogined  $event
     * @return void
     */
    public function handle(UserViewed $event)
    {
        $user = $event->user;
        Log::info("sombody viewed $user->username info!");
    }
}
