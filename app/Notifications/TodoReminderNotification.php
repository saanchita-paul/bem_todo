<?php

namespace App\Notifications;

use App\Services\CsvExportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TodoReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $todo;
    public $posts;

    public function __construct($todo, $posts)
    {
        $this->todo = $todo;
        $this->posts = $posts;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $fileName = 'posts_' . time() . '.csv';
        $data = array_map(function ($post) {
            return [$post['id'], $post['title'], $post['body']];
        }, $this->posts);

        $filePath = CsvExportService::generateCsv($data, ['ID', 'Title', 'Body'], $fileName);

        return (new MailMessage)
            ->subject('Todo Reminder: ' . $this->todo->title)
            ->line('You have a todo reminder.')
            ->line('Title: ' . $this->todo->title)
            ->line('Description: ' . $this->todo->description)
            ->line('Reminder Time: ' . $this->todo->reminder_at)
            ->attach($filePath, [
                'as' => $fileName,
                'mime' => 'text/csv',
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'todo_id' => $this->todo->id,
            'title' => $this->todo->title,
        ];
    }
}
