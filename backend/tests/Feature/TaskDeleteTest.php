<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_deleted(): void
    {
        $task = Task::create([
            'title' => 'Laravel',
            'description' => 'Practice task update',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Task deleted successfully');

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_delete_a_nonexistent_task_returns_404(): void
    {

        $response = $this->deleteJson("/api/tasks/999");

        $response->assertNotFound()
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Task with ID 999 not found');
    }
}
