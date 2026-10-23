<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']);

Route::post('/tasks', [TaskController::class, 'store']);
