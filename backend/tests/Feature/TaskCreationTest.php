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
            ->assertJsonPath('data.priority', $payload['priority'])->assertJsonPath('message', 'Task created successfully')
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


    public function test_title_cannot_exceed_150_characters(): void
    {
        $payload = [
            'title' => str_repeat('a', 151),
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_invalid_priority_is_rejected(): void
    {
        $payload = [
            'title' => 'Laravel',
            'priority' => 'urgent',
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['priority']);

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_invalid_due_date_is_rejected(): void
    {
        $payload = [
            'title' => 'Laravel',
            'due_date' => 'not-a-date',
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['due_date']);

        $this->assertDatabaseCount('tasks', 0);
    }
}
