<?php

namespace App\Http\Interfaces;


interface TaskInterface
{
    public function index();
    public function create($request);
    public function update($request);
    public function delete($id);
    public function send($id);
    public function sendToAll();
}
