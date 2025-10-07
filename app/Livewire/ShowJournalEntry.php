<?php

namespace App\Livewire;

use App\Models\JournalEntry;
use Livewire\Component;

class ShowJournalEntry extends Component
{
    public JournalEntry $journalEntry;

    public function mount(JournalEntry $journalEntry)
    {
        $this->journalEntry = $journalEntry;
    }

    public function delete()
    {
        $this->journalEntry->delete();
    }
}
