<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/task-list', [TaskController::class, 'list'])->name('api.task.list');
Route::post('/task-create', [TaskController::class, 'store'])->name('api.task.store');
