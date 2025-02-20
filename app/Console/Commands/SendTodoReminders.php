<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Notifications\TodoReminderNotification;
use App\Services\TodoReminderService;
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
    protected $description = 'Send reminder notifications for pending To-Do items';

    protected TodoReminderService $todoReminderService;

    public function __construct(TodoReminderService $todoReminderService)
    {
        parent::__construct();
        $this->todoReminderService = $todoReminderService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->todoReminderService->sendReminders();
        $this->info('Reminder emails sent successfully.');
    }
}
