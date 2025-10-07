<?php

use App\Livewire\JournalEntryIndex;
use App\Livewire\ShowJournalEntry;
use App\Models\JournalEntry;
use Livewire\Livewire;

it('renders successfully', function () {

    $journalEntry = JournalEntry::factory()->create([
        'title' => 'banana pepper',
        'plant_name' => 'banana pepper',
        'notes' => 'green and spicy?',
    ]);
    Livewire::test(ShowJournalEntry::class, ['journalEntry' => $journalEntry])
        ->assertStatus(200);
});

it('shows the journal entry', function () {
    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);

    Livewire::test(ShowJournalEntry::class, ['journalEntry' => $journalEntry])
        ->assertSee(['First Post', 'Yarrow', 'Went on a walk and found a yellow flowering plant.']);

});

it('deletes journal entry after clicking delete', function () {

    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);

    $this->assertDatabaseHas('journal_entries', [
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);

    Livewire::test(ShowJournalEntry::class, ['journalEntry' => $journalEntry])
        ->call('delete');
    $this->assertDatabaseMissing('journal_entries', [
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);
});

it('redirects to journal entry index after clicking back button', function () {
    $journalEntry = JournalEntry::factory()->create([
        'title' => 'Sweet small daisy',
        'plant_name' => 'Daisy',
        'notes' => 'The field is full of sweet small daisies. So pretty!',
    ]);

    Livewire::test(ShowJournalEntry::class, ['journalEntry' => $journalEntry])
        ->call('Back');

    Livewire::test(JournalEntryIndex::class, ['journalEntry' => $journalEntry])
        ->assertSee(['Sweet small daisy', 'Daisy']);

}
);
