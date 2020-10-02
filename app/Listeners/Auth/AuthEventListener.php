<?php

namespace App\Listeners\Auth;

use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// events to Handle
use App\Events\Auth\{
    UserRegistered,
};

use App\Mail\Frontend\EmailVerifiy;
use App\Mail\Frontend\AgentRegisteredMail;

class AuthEventListener
{
    public function handleUserRegistered($event) {
        Mail::to($event->user->email)->send(new EmailVerifiy($event->user));
    }

    public function subscribe($events)
    {
        $events->listen(
            UserRegistered::class,
            'App\Listeners\Auth\AuthEventListener@handleUserRegistered'
        );
    }

}
