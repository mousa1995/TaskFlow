<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->get();

        return response()->json([
            'success' => true,
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks,
        ], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => "Task created successfully",
            'data' => $task,
        ], 201);
    }

    public function show(int $task)
    {


        $thisTask = Task::find($task);

        if (!$thisTask) {
            return response()->json([
                'success' => false,
                'message' => "Task with ID {$task} not found",
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task retrieved successfully',
            'data' => $thisTask,
        ], 200);
    }
}
