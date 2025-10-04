<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoonlightMessageSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_moonlight_message_can_be_stored(): void
    {
        $payload = [
            'to' => '@dawn',
            'topic' => 'gratitude',
            'subject' => 'Morning Stars',
            'body' => 'Thank you for always meeting me before sunrise.',
        ];

        $response = $this->post(route('messages.store'), $payload);

        $response->assertStatus(302)->assertRedirect(route('messages'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('moonlight_messages', [
            'to' => '@dawn',
            'topic' => 'gratitude',
            'subject' => 'Morning Stars',
        ]);
    }
}
