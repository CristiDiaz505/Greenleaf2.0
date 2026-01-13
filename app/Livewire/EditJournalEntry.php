<?php

namespace App\Livewire;

use App\Livewire\Forms\JournalEntryForm;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditJournalEntry extends Component
{
    use WithFileUploads;

    public JournalEntryForm $form;

    public JournalEntry $journalEntry;

    public function mount(JournalEntry $journalEntry)
    {
        $this->form->setJournalEntry($journalEntry);

    }

    public function submit()
    {
        // Validate the form data, including the image
        $this->validate();

        // If a new image is uploaded, store it and update the path
        if ($this->form->image) {
            $this->form->image_path = $this->form->image->store('photos', 'public');
        }

        $this->form->update();

        return redirect()->route('journalEntries.show', $this->journalEntry);
    }

    public function delete()
    {
        // Delete the image file if it exists
        if ($this->journalEntry->image_path) {
            Storage::disk('public')->delete($this->journalEntry->image_path);
        }

        $this->journalEntry->delete();

        return redirect()->route('journalEntries.index');
    }

    public function render()
    {
        return view('livewire.edit-journal-entry');
    }
}
