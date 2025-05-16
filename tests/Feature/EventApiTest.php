<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase; // Optional: If you want to refresh the database for each test

    public function test_can_get_events()
    {
        $response = $this->getJson('/api/events');
        $response->assertStatus(200);
    }

    public function test_can_create_event()
    {
        $data = [
            'title' => 'Test Event', 
            'description' => 'Event description', 
            'date' => now()
        ];
        $response = $this->postJson('/api/events', $data);
        $response->assertStatus(201);
    }
}
