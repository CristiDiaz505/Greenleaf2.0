<?php

namespace App\Livewire\Forms;

use App\Models\JournalEntry;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JournalEntryForm extends Form
{
    public ?JournalEntry $journalEntry = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|string|max:255')]
    public $plant_name = '';

    #[Validate('required|string')]
    public $notes = '';

    #[Validate('nullable|image|max:1024')]
    public $image = null;

    public $image_path = null;

    public function setJournalEntry(JournalEntry $journalEntry)
    {
        $this->journalEntry = $journalEntry;
        $this->title = $journalEntry->title;
        $this->plant_name = $journalEntry->plant_name;
        $this->notes = $journalEntry->notes;
        $this->image_path = $journalEntry->image_path;
    }

    public function store()
    {
        $this->validate();

        JournalEntry::create($this->except('journalEntry', 'image'));
    }

    public function update()
    {
        $this->validate();

        $this->journalEntry->update(
            $this->except('journalEntry', 'image')
        );
    }
}
