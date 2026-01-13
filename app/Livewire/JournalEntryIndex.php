<?php

namespace App\Livewire;

use App\Models\JournalEntry;
use Livewire\Component;
use Livewire\WithPagination;

class JournalEntryIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $journalEntries = JournalEntry::query()
            ->where('title', 'like', "%{$this->search}%")
            ->orWhere('plant_name', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(10);

        return view('livewire.journal-entry-index', [
            'journalEntries' => $journalEntries,
        ]);
    }
}
