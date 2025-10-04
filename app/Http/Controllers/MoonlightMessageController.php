<?php

namespace App\Http\Controllers;

use App\Models\MoonlightMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MoonlightMessageController extends Controller
{
    /**
     * Store a newly created moonlight message.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'to' => ['required', 'string', 'max:120'],
            'topic' => ['required', 'string', Rule::in(['gratitude', 'check-in', 'affirmation', 'invite'])],
            'subject' => ['nullable', 'string', 'max:80'],
            'body' => ['required', 'string', 'max:800'],
        ]);

        MoonlightMessage::create($validated);

        return redirect()
            ->route('messages')
            ->with('status', 'Your moonlight message is on its way.');
    }
}
