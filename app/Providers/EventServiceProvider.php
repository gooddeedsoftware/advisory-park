<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Providers\AuthTimeoutMiddleware;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        /*\JulioMotol\AuthTimeout\Events\AuthTimeoutEvent::class => [
            UserLogoutOnSessionExpire::class,
        ],*/
    ];

    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        /*AuthTimeoutMiddleware::setRedirectTo(function ($request, $guard){
            return route('logout');
        });*/
    }
}
