<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JournalEntryController extends Controller
{
    /**
     * Store a newly created journal entry.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:80'],
            'mood' => ['required', 'string', Rule::in(['calm', 'wistful', 'curious', 'restless', 'light'])],
            'quality' => ['required', 'integer', 'between:1,5'],
            'body' => ['required', 'string', 'max:2000'],
        ]);

        JournalEntry::create($validated);

        return redirect()
            ->route('journal')
            ->with('status', 'Your dream entry was saved.');
    }
}
