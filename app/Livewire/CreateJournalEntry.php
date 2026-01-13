<?php

namespace App\Livewire;

use App\Livewire\Forms\JournalEntryForm;
use Cloudstudio\Ollama\Facades\Ollama;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateJournalEntry extends Component
{
    use WithFileUploads;

    public JournalEntryForm $form;

    public function submit()
    {
        $this->validate();

        if ($this->form->image) {
            $this->form->image_path = $this->form->image->store('photos', 'public');
        }

        $this->form->store();

        return redirect()->route('journalEntries.index');
    }

    public function generateAi()
    {
        if ($this->form->image) {
            $this->form->image_path = $this->form->image->store('photos', 'public');
        }

        $ollamaResponse = Ollama::model(config('ollama-laravel.model'))
            ->prompt('tell me what plant you see in this image and give only the name of the plant and nothing else')
            ->image(storage_path('app/public/'.$this->form->image_path))
            ->ask();

        $this->form->plant_name = $ollamaResponse['response'];
    }

    public function render()
    {
        return view('livewire.create-journal-entry');
    }
}
