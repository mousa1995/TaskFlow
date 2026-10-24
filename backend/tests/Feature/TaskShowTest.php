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
            ->assertJsonPath('data.id', $task->id)
            ->assertJsonPath('data.title', 'Laravel')
            ->assertJsonPath('data.description', 'practice task show');
    }
}
