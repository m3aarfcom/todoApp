<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Events\SendMail;
use Illuminate\Console\Command;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Notification;

class TaskDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check daily due date of tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('due_date', today())->get();

        $users_ids = [];

        foreach ($tasks as $task) {
            $users = $task->users()->get();
            foreach ($users as $user) {
                $users_ids[] = $user->user_id;
            }
        }
        event(new SendMail($users_ids));
        Notification::send($users, new  TasksNotification($task));
    }
}
