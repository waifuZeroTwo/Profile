<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JournalEntrySubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_journal_entry_can_be_stored(): void
    {
        $payload = [
            'title' => 'Glowing Tides',
            'mood' => 'calm',
            'quality' => 4,
            'body' => 'I walked across shimmering water and the stars hummed softly.',
        ];

        $response = $this->post(route('journal.store'), $payload);

        $response->assertStatus(302)->assertRedirect(route('journal'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('journal_entries', [
            'title' => 'Glowing Tides',
            'mood' => 'calm',
            'quality' => 4,
        ]);
    }
}
