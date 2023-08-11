<?php

namespace App\Providers;

use App\Mail\NewPostEmail;
use App\Models\Notification;
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
     * 
     */
    public function handle(NewPostEvent $event): void
    {
        /**
         * new post is create: we send an email here as well asynchronesly
        */
        foreach ($event->post->website->subs as $sub) {
            error_log("Email is Sent to:".$sub->user);
            // to send real email
            // Mail::to($sub->user)->send(new NewPostEmail($event->post));
            $notification = new Notification();
            $notification->user_id = $sub->user_id;
            $notification->post_id = $event->post->id;
            $notification->save();
        }
    }
}
