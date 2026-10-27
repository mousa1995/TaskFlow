<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_shown(): void
    {
        $task = Task::create([
            'title' => 'Laravel',
            'description' => 'practice task show',
            'status' => 'pending',
            'priority' => 'high',
        ]);

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Task retrieved successfully')
            ->assertJsonPath('data.id', $task['id'])
            ->assertJsonPath('data.title', $task['title'])
            ->assertJsonPath('data.description', $task['description'])
            ->assertJsonPath('data.status', $task['status'])
            ->assertJsonPath('data.priority', $task['priority'])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'priority',
                    'due_date',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_a_missing_task_returns_404(): void
    {
        $response = $this->getJson('/api/tasks/999999');

        $response->assertNotFound()
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Task with ID 999999 not found');
    }
}
