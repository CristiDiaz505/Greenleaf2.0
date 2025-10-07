<?php

namespace App\Livewire;

use App\Livewire\Forms\JournalEntryForm;
use App\Models\JournalEntry;
use Livewire\Component;

class EditJournalEntry extends Component
{
    public JournalEntryForm $form;

    public JournalEntry $journalEntry;

    public function mount(JournalEntry $journalEntry)
    {
        $this->form->setJournalEntry($journalEntry);

    }

    public function submit()
    {
        $this->form->update();

        return redirect()->route('journalEntries.index');
    }
}
