<?php

namespace App\Listeners;

use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class LogEmailNotification
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
    public function handle(NotificationSent $event)
    {
        // Ensure notifiable has email property
        if (!isset($event->notifiable->email)) {
            return;
        }

        $emailData = $event->notification->toMail($event->notifiable);

        EmailLog::create([
            'recipient' => $event->notifiable->email,
            'subject' => $emailData->subject,
            'body' => method_exists($emailData, 'render') ? $emailData->render() : null,
        ]);
    }
}
