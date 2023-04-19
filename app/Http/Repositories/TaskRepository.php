<?php



namespace App\Http\Repositories;

use App\Models\Task;

use App\Models\User;
use App\Events\SendMail;
use App\Http\Interfaces\TaskInterface;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Notification;

class TaskRepository implements TaskInterface
{

    public Task $task;
    public User $user;
    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }
    public function index()
    {
        $users =   $this->user::role('employee')->get();

        $notifications = auth()->user()->unreadNotifications ?? null;

        if (auth()->user()->hasRole('manager')) {
            $tasks = $this->task::get();
        } else {

            $tasks =   $this->task::WhereHas('users', function ($q) {
                $q->where('user_id', auth()->id());
            })->get();
        }

        return view('tasks.index', compact('tasks', 'users', 'notifications'));
    }

    public function create($data)
    {
        $task =  $this->task::create($data);
        $ids = [];

        foreach ($data['user_ids'] as $id) {
            $ids[] = $id;
        }
        $task->users()->sync($ids);
        return $task;
    }

    public function update($data)
    {
        $task =  $this->task::findOrFail($data['task_id']);
        $task->update($data);

        $ids = [];
        foreach ($data['user_ids'] as $id) {
            $ids[] = $id;
        }
        $task->users()->sync($ids);
        return  redirect()->route('home');
    }

    public function edit($id)
    {
        $users =   $this->user::role('employee')->get();
        $task =    $this->task::findOrFail($id);
        return view('tasks.edit', compact('task', 'users'));
    }
    public function delete($id)
    {
        return     $this->task::findOrFail($id)->delete();
    }

    public function toggle($request, $id)
    {
        $status = 0;
        if ($request->status === 'in_progress') {
            $status = 1;
        } elseif ($request->status === 'completed') {
            $status = 2;
        }
        $task =  $this->task::findOrFail($id)->update([
            'status' => $status,
        ]);
        return back();
    }


    public function send($id)
    {
        $task = Task::find($id);
        $users = $task->users()->get();
        $ids = [];
        foreach ($users as $user) {
            $ids[] = $user->user_id;
        }
        event(new SendMail($ids));

        Notification::send($users, new  TasksNotification($task));

        return back();
    }
    public function sendToAll()
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
        return back();
    }

    public function markNotification($id = null)
    {
        auth()->user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();
        return back();
    }
}
