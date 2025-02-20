<?php

namespace App\Listeners;

use App\Services\EmailLogService;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\SentMessage;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class LogEmailListener
{
    /**
     * Create the event listener.
     */
    protected EmailLogService $emailLogService;

    public function __construct(EmailLogService $emailLogService)
    {
        $this->emailLogService = $emailLogService;
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event)
    {
        if (!$event->sent instanceof SentMessage) {
            return;
        }

        $this->emailLogService->logEmail($event->sent, $event->data ?? []);
    }
}
