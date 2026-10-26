<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskFilteringTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_can_be_filtered_by_status(): void
    {
        Task::factory()->create([
            'title' => 'Pending task',
            'status' => 'pending',
        ]);

        Task::factory()->create([
            'title' => 'Completed task',
            'status' => 'completed',
        ]);

        $response = $this->getJson("/api/tasks?status=pending");

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', 'Pending task');
    }

    public function test_a_task_can_be_filtered_by_priority(): void
    {
        Task::factory()->create([
            'title' => 'High priority task',
            'priority' => 'high',
        ]);

        Task::factory()->create([
            'title' => 'Low priority task',
            'priority' => 'low',
        ]);

        $response = $this->getJson("/api/tasks?priority=high");

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', 'High priority task');
    }
}
