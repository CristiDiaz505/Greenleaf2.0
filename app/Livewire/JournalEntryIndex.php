<?php

namespace App\Livewire;

use App\Models\JournalEntry;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class JournalEntryIndex extends Component
{
    public function render()
    {
        return view('livewire.journal-entry-index');
    }

    public Collection $journalEntries;

    public function mount()
    {
        $this->journalEntries = JournalEntry::all();
    }
}
