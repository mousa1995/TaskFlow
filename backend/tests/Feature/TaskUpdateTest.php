<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_updated(): void
    {
        $task = Task::create([
            'title' => 'Old title',
            'description' => 'Old description',
            'status' => 'pending',
            'priority' => 'low',
        ]);

        $payload = [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => '2026-11-01',
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $payload);

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Task updated successfully')
            ->assertJsonPath('data.id', $task->id)
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.description', $payload['description'])
            ->assertJsonPath('data.status', $payload['status'])
            ->assertJsonPath('data.priority', $payload['priority'])
            ->assertJsonPath('data.due_date', $payload['due_date']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $payload['title'],
            'description' => $payload['description'],
            'status' => $payload['status'],
            'priority' => $payload['priority'],
            'due_date' => $payload['due_date'],
        ]);
    }

    public function test_a_missing_task_returns_404(): void
    {
        $response = $this->putJson('/api/tasks/999999', ['title' => 'Updated title']);


        $response->assertNotFound()
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Task with ID 999999 not found');
    }

    public function test_invalid_status_is_rejected(): void
    {
        $task = Task::create([
            'title' => 'Laravel',
            'description' => 'Practice task update',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $payload = [
            'title' => 'Laravel',
            'status' => 'unknown',
        ];


        $response = $this->putJson("/api/tasks/{$task->id}", $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['status']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Laravel',
            'status' => 'pending',
            'priority' => 'medium',
        ]);
    }

    public function test_a_task_can_partially_be_updated(): void
    {
        $task = Task::create([
            'title' => 'Laravel',
            'description' => 'Practice task update',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $payload = [
            'status' => 'completed',
        ];

        $response = $this->patchJson("/api/tasks/{$task->id}", $payload);

        $response->assertOk()
            ->assertJsonPath('data.status', $payload['status'])
            ->assertJsonPath('data.id', $task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Laravel',
            'status' => 'completed',
            'priority' => 'medium',
        ]);
    }
}
