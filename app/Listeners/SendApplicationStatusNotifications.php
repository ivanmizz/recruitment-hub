<?php

namespace App\Listeners;

use App\Events\ApplicationStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ApplicationStatus;
use App\Models\User;
class SendApplicationStatusNotifications
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
    public function handle(ApplicationStatusUpdated $event): void
    {
        
        foreach (User::where('id', $event->application->user_id)->cursor() as $user) {
            $user->notify(new ApplicationStatus($event->application));
        }
    }
}
