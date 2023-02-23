<?php

namespace App\Providers;

use App\Events\JulioMotol\AuthTimeout\Events\AuthTimeoutEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLogoutOnSessionExpire
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
     * @param  \App\Events\JulioMotol\AuthTimeout\Events\AuthTimeoutEvent  $event
     * @return void
     */
    public function handle(AuthTimeoutEvent $event)
    {   
        // $event->user;   // The user that timed out.
        // $event->guard;  // The authentication guard.
    }
}
