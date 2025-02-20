<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Notifications\TodoReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class SendTodoReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:todo-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todos = Todo::
//        where('reminder_at', '<=', now()->addMinutes(10))
            where('email_notification_sent', false)
            ->with('user')
            ->get();

        foreach ($todos as $todo) {
            if (!$todo->user || !$todo->user->email) {
                \Log::warning("No user or email found for To-Do ID: {$todo->id}");
                continue;
            }

            // Fetch 10 posts from API
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            if ($response->failed()) {
                \Log::error("Failed to fetch posts from API.");
                continue;
            }

            $posts = array_slice($response->json(), 0, 10); // Take first 10 posts

            // Send notification to the user
            Notification::send($todo->user, new TodoReminderNotification($todo, $posts));

            // Mark email as sent
            $todo->update(['email_notification_sent' => true]);

            \Log::info("Reminder email sent for To-Do: {$todo->id}");
        }

        $this->info('Reminder emails sent successfully.');
    }
}
