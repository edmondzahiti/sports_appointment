<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegistered;
use App\Mail\Frontend\EmailVerifiy;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailVerify
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

    public function handle(UserRegistered $event)
    {
        \Mail::to($event->email)->send(
            new EmailVerifiy($event)
        );
    }
}
