<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']);

Route::post('/tasks', [TaskController::class, 'store']);

Route::get('/tasks/{task}', [TaskController::class, 'show'])->whereNumber('task');

Route::match(['put', 'patch'], '/tasks/{task}', [TaskController::class, 'update'])->whereNumber('task');
