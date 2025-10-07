<?php

use App\Livewire\CreateJournalEntry;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateJournalEntry::class)
        ->assertStatus(200);
});

it('creates a journal entry', function () {
    Livewire::test(CreateJournalEntry::class)
        ->set('form.title', '02-12-25 Versailles')
        ->set('form.plant_name', 'plantain')
        ->set('form.notes', 'lots of them clustered')
        ->call('submit');
    $this->assertDatabaseHas('journal_entries', ['title' => '02-12-25 Versailles', 'plant_name' => 'plantain', 'notes' => 'lots of them clustered']);
});

describe('validation Rules', function () {
    it('requires Title and Plantname and Notes', function () {
        Livewire::test(CreateJournalEntry::class)
            ->set('form.title', null)
            ->set('form.plant_name', null)
            ->set('form.notes', null)
            ->call('submit')
            ->assertHasErrors([
                'form.title' => 'required',
                'form.plant_name' => 'required',
                'form.notes' => 'required',
            ])->assertSee([
                'The title field is required.',
                'The plant name field is required.',
                'The notes field is required.',
            ]);
    });
});

it('redirects to JournalEntries after submitting', function () {
    Livewire::test(CreateJournalEntry::class)
        ->set('form.title', 'marigoldsss')
        ->set('form.plant_name', 'marigold')
        ->set('form.notes', 'flowering marigolds')
        ->call('submit')
        ->assertRedirect(route('journalEntries.index'));
});
