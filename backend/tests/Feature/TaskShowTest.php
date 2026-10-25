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
            ->assertJsonPath('data.id', $task['id'])
            ->assertJsonPath('data.title', $task['title'])
            ->assertJsonPath('data.description', $task['description']);
    }

    public function test_a_missing_task_returns_404(): void
    {
        $response = $this->getJson('/api/tasks/999999');

        $response->assertNotFound()
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Task with ID 999999 not found');
    }
}
