<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;

        $this->middleware('permission:read_task', ['only' => ['index']]);
        $this->middleware('permission:create_task', ['only' => ['store']]);
        $this->middleware('permission:update_task', ['only' => ['edit', 'update', 'send', 'sendToAll']]);
        $this->middleware('permission:delete_task', ['only' => ['delete']]);
    }


    public function index()
    {
        return  $this->taskService->index();
    }
    public function store(TodoRequest $request)
    {

        $data = $request->all();
        $this->taskService->create($data);

        return back();
    }

    public function edit($id)
    {
        return   $this->taskService->edit($id);
    }
    public function update(TodoRequest $request)
    {
        $data = $request->all();
        return  $this->taskService->update($data);
    }

    public function delete($id)
    {
        $this->taskService->delete($id);
        return back();
    }

    public function toggle(Request $request, $id)
    {
        $this->taskService->toggle($request, $id);
        return back();
    }

    public function send($id)
    {
        $this->taskService->send($id);
        return back();
    }
    public function sendToAll()
    {
        $this->taskService->sendToAll();
        return back();
    }


    public function markNotification($id = null)
    {
        $this->taskService->markNotification($id);
        return back();
    }
}
