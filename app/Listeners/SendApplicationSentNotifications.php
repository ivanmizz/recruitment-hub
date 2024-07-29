<?php

namespace App\Listeners;

use App\Events\ApplicationSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewApplication;

class SendApplicationSentNotifications
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
    public function handle(ApplicationSent $event): void
    {
        foreach (User::where('id', $event->application->listing->user_id)->cursor() as $user) {
            $user->notify(new NewApplication($event->application));
        }
    }
}
