<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_are_paginated_ten_per_page(): void
    {
        Task::factory()->count(15)->create();

        $response = $this->getJson("/api/tasks");

        $response->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('meta.total', 15)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.last_page', 2);
    }

    public function test_second_page_returns_remaining_tasks(): void
    {
        Task::factory()->count(15)->create();

        $response = $this->getJson("/api/tasks?page=2");

        $response->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('meta.total', 15)
            ->assertJsonPath('meta.current_page', 2);
    }

    public function test_pagination_works_with_filters(): void
    {
        Task::factory()->count(12)->create(['status' => 'pending']);
        Task::factory()->count(3)->create(['status' => 'completed']);

        $response = $this->getJson('/api/tasks?status=pending');

        $response->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('meta.total', 12);
    }
}
