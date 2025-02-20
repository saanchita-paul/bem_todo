<?php

namespace App\Services;

use App\Models\Todo;
use App\Notifications\TodoReminderNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class TodoReminderService
{
    public function sendReminders()
    {
        $todos = Todo::where('reminder_at', '<=', now()->addMinutes(10))
                ->where('email_notification_sent', false)
                ->with('user')
                ->get();

        foreach ($todos as $todo) {
            if (!$todo->user || !$todo->user->email) {
                Log::warning("No user or email found for To-Do ID: {$todo->id}");
                continue;
            }

            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            if ($response->failed()) {
                Log::error("Failed to fetch posts from API.");
                continue;
            }

            $posts = array_slice($response->json(), 0, 10);


            Notification::send($todo->user, new TodoReminderNotification($todo, $posts));


            $todo->update(['email_notification_sent' => true]);

            Log::info("Reminder email sent for To-Do: {$todo->id}");
        }
    }
}
