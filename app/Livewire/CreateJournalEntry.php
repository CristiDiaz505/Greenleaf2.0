<?php

namespace App\Livewire;

use App\Livewire\Forms\JournalEntryForm;
use App\Models\JournalEntry;
use Livewire\Component;

class CreateJournalEntry extends Component
{
    public JournalEntryForm $form;

    public function submit()
    {
        $this->validate();
        JournalEntry::create($this->form->only([
            'title',
            'plant_name',
            'notes',
        ]));

        return redirect()->route('journalEntries.index');

    }
}
