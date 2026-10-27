<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        $query->when($request->query('status'), function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($request->query('priority'), function ($query, $priority) {
            $query->where('priority', $priority);
        });

        $query->when($request->query('search'), function ($query, $searched) {
            $query->where('title', 'like', '%' . $searched . '%');
        });

        $tasks = $query->paginate(10);

        return TaskResource::collection($tasks)->additional([
            'success' => true,
            'message' => 'Tasks retrieved successfully',
        ]);
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
            'data' => new TaskResource($thisTask),
        ], 200);
    }

    public function update(UpdateTaskRequest $request, int $task)
    {
        $thisTask = Task::find($task);

        if (!$thisTask) {
            return response()->json([
                'success' => false,
                'message' => "Task with ID {$task} not found",
                'data' => [],
            ], 404);
        }

        $validated = $request->validated();

        $thisTask->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $thisTask->fresh(),
        ], 200);
    }

    public function destroy(int $task)
    {
        $thisTask = Task::find($task);

        if (!$thisTask) {
            return response()->json([
                'success' => false,
                'message' => "Task with ID {$task} not found",
                'data' => [],
            ], 404);
        }

        $thisTask->delete();
        return response()->json([
            "success" => true,
            "message" => 'Task deleted successfully',
            "data" => [],
        ], 200);
    }
}
