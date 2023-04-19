<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTask
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
    public function handle(SendMail $event): void
    {
        $users = User::whereIn('id', $event->userIds)->select('id', 'email', 'name')->get()->toArray();
        foreach ($users as $user) {
            Mail::send('emails.taskEmails', $user, function ($message) use ($user) {
                $message->to($user['email']);
                $message->subject('Task Due Date Alarm');
            });
        }
    }
}
