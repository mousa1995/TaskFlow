<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_can_be_created(): void
    {
        $payload = [
            'title' => 'Laravel',
            'description' => 'practice task creation',
            'status' => 'pending',
            'priority' => 'high',

        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertCreated()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.description', $payload['description'])
            ->assertJsonPath('data.status', $payload['status'])
            ->assertJsonPath('data.priority', $payload['priority']);

        $this->assertDatabaseHas('tasks', [
            'title' => $payload['title'],
            'description' => $payload['description'],
            'status' => $payload['status'],
            'priority' => $payload['priority']
        ]);
    }

    public function test_title_is_required(): void
    {
        $payload = [
            'description' => 'Practice validation',
            'status' => 'pending',
            'priority' => 'high',
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_invalid_status_is_rejected(): void
    {
        $payload = [
            'title' => 'Laravel',
            'status' => 'unknown',
            'priority' => 'high',
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['status']);

        $this->assertDatabaseCount('tasks', 0);
    }
}
