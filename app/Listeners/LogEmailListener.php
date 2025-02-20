<?php

namespace App\Listeners;

use App\Models\EmailLog;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\SentMessage;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class LogEmailListener
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
    public function handle(MessageSent $event)
    {
        if (!$event->sent instanceof SentMessage) {
            return;
        }

        $data = $event->data ?? [];
        $notifiable = $data['__laravel_notification'] ?? null;
        $mailable = $data['__laravel_mailable'] ?? null;

        $recipient = $event->sent->getOriginalMessage()->getTo()[0]->getAddress() ?? null;


        $subject = $event->sent->getOriginalMessage()->getSubject() ?? null;

        $body = $event->sent->getOriginalMessage()->getHtmlBody() ?? $event->sent->getOriginalMessage()->getTextBody() ?? null;

        if ($recipient && $subject && $body) {
            EmailLog::create([
                'recipient' => $recipient,
                'subject' => $subject,
                'body' => $body,
                'notification_type' => $notifiable ? 'notification' : ($mailable ? 'mailable' : 'unknown'),
            ]);
        }
    }
}
