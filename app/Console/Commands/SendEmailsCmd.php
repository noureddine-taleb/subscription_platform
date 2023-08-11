<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Console\Command;

class SendEmailsCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send emails to subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * note that this might not always work, because the email notification
         * might already been sent when the post is created. check SendEmailNotification::class
        */
        foreach (Subscription::all() as $sub) {
            foreach ($sub->website->posts as $post) {
                if (Notification::where("user_id", $sub->user_id)->where("post_id", $post->id)->count() == 0) {
                    $notification = new Notification();
                    $notification->user_id = $sub->user_id;
                    $notification->post_id = $post->id;
                    $notification->save();
                    error_log("Email is Sent to:".$sub->user);
                    // to send mail
                    // Mail::to($sub->user)->send(new NewPostEmail($event->post));
                }
            }
        }
    }
}
