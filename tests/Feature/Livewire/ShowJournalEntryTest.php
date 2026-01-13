<?php

use App\Livewire\ShowJournalEntry;
use App\Models\JournalEntry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

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

it('shows the journal entry image', function () {
    Storage::fake('public');

    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
        'image_path' => 'photos/test.jpg',
    ]);

    Livewire::test(ShowJournalEntry::class, ['journalEntry' => $journalEntry])
        ->assertSee(Storage::url('photos/test.jpg'));

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
