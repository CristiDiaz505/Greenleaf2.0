<?php

use App\Livewire\EditJournalEntry;
use App\Models\JournalEntry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('deletes a journal entry and redirects', function () {
    $journalEntry = JournalEntry::factory()->create();

    $this->assertDatabaseHas('journal_entries', ['id' => $journalEntry->id]);

    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->call('delete')
        ->assertRedirect(route('journalEntries.index'));

    $this->assertDatabaseMissing('journal_entries', ['id' => $journalEntry->id]);
});
