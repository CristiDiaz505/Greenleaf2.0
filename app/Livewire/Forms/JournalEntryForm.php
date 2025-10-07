<?php

namespace App\Livewire\Forms;

use App\Models\JournalEntry;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JournalEntryForm extends Form
{
    public ?JournalEntry $journalEntry;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $plant_name;

    #[Validate('required')]
    public $notes;

    public function setJournalEntry(JournalEntry $journalEntry)
    {
        $this->journalEntry = $journalEntry;
        $this->title = $journalEntry->title;
        $this->plant_name = $journalEntry->plant_name;
        $this->notes = $journalEntry->notes;
    }

    public function update()
    {
        $this->validate();
        $this->journalEntry->update(
            $this->only(['title', 'plant_name', 'notes'])
        );
    }
}
