<?php

namespace App\Providers;

use App\Mail\NewPostEmail;
use App\Models\User;
use App\Models\Website;
use App\Providers\NewPostEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewPostEvent $event): void
    {
        $subs = $event->post->website->subs;
        foreach ($subs as $sub) {
            error_log("Email is Sent.".$sub->user);
            Mail::to($sub->user)->send(new NewPostEmail($event->post));
        }
    }
}
