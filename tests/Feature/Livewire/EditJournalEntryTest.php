<?php

use App\Livewire\EditJournalEntry;
use App\Models\JournalEntry;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(EditJournalEntry::class)
        ->assertStatus(200);
});

it('pre-fills the form with the journal entry data', function () {
    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);

    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->assertSet('form.journalEntry', $journalEntry)
        ->assertSet('form.journalEntry.title', 'First Post')
        ->assertSet('form.journalEntry.plant_name', 'Yarrow')
        ->assertSet(
            'form.journalEntry.notes',
            'Went on a walk and found a yellow flowering plant.'
        );
});

it('updates the journal entry fields when user changes data', function () {
    // create a journal entry
    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);
    $submission = [
        'title' => 'Changing Post',
        'plant_name' => 'Grass',
        'notes' => 'Went on a walk and found lots of grass.',
    ];

    // user changes field values
    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->set('form.title', 'Changing Post')
        ->set('form.plant_name', 'Grass')
        ->set('form.notes', 'Went on a walk and found lots of grass.')
        ->call('submit');

    // record is updated
    $this->assertEquals($journalEntry->fresh()->only(['title', 'plant_name', 'notes']), $submission);
});

it('redirects after saving to showJournalEntry', function () {
    //
});
