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

    public function test_tasks_can_be_filtered_with_priority_and_status(): void
    {
        Task::factory()->create([
            'title' => 'Low completed task',
            'priority' => 'low',
            'status' => 'completed',
        ]);

        Task::factory()->create([
            'title' => 'Low pending task',
            'priority' => 'low',
            'status' => 'pending',
        ]);

        Task::factory()->create([
            'title' => 'High completed task',
            'priority' => 'high',
            'status' => 'completed',
        ]);

        $response = $this->getJson('/api/tasks?priority=low&status=completed');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', 'Low completed task');
    }

    public function test_tasks_can_be_searched_by_title(): void
    {
        Task::factory()->create([
            'title' => 'Learn Laravel API',
        ]);

        Task::factory()->create([
            'title' => 'Build React interfaces',
        ]);

        Task::factory()->create([
            'title' => 'Laravel testing basics',
        ]);

        $response = $this->getJson("/api/tasks?search=Laravel");

        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonFragment([
                'title' => 'Learn Laravel API',
            ])
            ->assertJsonFragment([
                'title' => 'Laravel testing basics',
            ]);
    }

    public function test_search_returns_empty_results_when_no_task_matches(): void
    {
        Task::factory()->create([
            'title' => 'Learn Laravel',
        ]);

        $response = $this->getJson('/api/tasks?search=Nonexistent');

        $response->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('success', true);
    }
}
