<?php

namespace App\Services;

use App\Models\EmailLog;
use Illuminate\Mail\SentMessage;

class EmailLogService
{
    /**
     * Log email details.
     */
    public function logEmail(SentMessage $sentMessage, ?array $data = [])
    {
        $notifiable = $data['__laravel_notification'] ?? null;
        $mailable = $data['__laravel_mailable'] ?? null;

        $recipient = $sentMessage->getOriginalMessage()->getTo()[0]->getAddress() ?? null;
        $subject = $sentMessage->getOriginalMessage()->getSubject() ?? null;
        $body = $sentMessage->getOriginalMessage()->getHtmlBody() ?? $sentMessage->getOriginalMessage()->getTextBody() ?? null;

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
