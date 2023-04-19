<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Auth::routes();


Route::get('/', function () {
    return    redirect('home');
});
Route::group(['middleware' => 'auth', 'role:manager'], function () {

    Route::get('/home', [TaskController::class, 'index'])->name('home');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/tasks/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/tasks/update', [TaskController::class, 'update'])->name('task.update');
    Route::get('/tasks/toggle/{id}/{status}', [TaskController::class, 'toggle'])->name('task.toggle');
    Route::get('/send/{id}', [TaskController::class, 'send'])->name('task.send');
    Route::get('/sendToAll', [TaskController::class, 'sendToAll'])->name('task.sendToAll');

    Route::get('mark-as-read/{id?}', [TaskController::class, 'markNotification'])->name('task.markNotification');
});
