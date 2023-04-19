<?php

namespace App\Http\Services;

use App\Http\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        return $this->taskRepository->index();
    }
    public function create($data)
    {
        return $this->taskRepository->create($data);
    }
    public function update($data)
    {
        return $this->taskRepository->update($data);
    }
    public function edit($id)
    {
        return $this->taskRepository->edit($id);
    }
    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }
    public function toggle($data, $id)
    {
        return $this->taskRepository->toggle($data, $id);
    }
    public function send($id)
    {
        return $this->taskRepository->send($id);
    }
    public function sendToAll()
    {
        return $this->taskRepository->sendToAll();
    }
    public function markNotification($id = null)
    {
        return $this->taskRepository->markNotification($id);
    }
}
