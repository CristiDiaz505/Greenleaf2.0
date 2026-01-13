<?php

use App\Livewire\EditJournalEntry;
use App\Models\JournalEntry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

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

it('can update a journal entry with a new image', function () {
    Storage::fake('public');

    $journalEntry = JournalEntry::factory()->create();
    $newImage = UploadedFile::fake()->image('new-photo.jpg');

    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->set('form.title', 'A New Title')
        ->set('form.image', $newImage)
        ->call('submit');

    $journalEntry->refresh();

    expect($journalEntry->title)->toBe('A New Title');
    expect($journalEntry->image_path)->not->toBeNull();
    Storage::disk('public')->assertExists($journalEntry->image_path);
});

it('retains the original image if a new one is not uploaded', function () {
    Storage::fake('public');

    $originalImage = UploadedFile::fake()->image('original.jpg');
    $path = $originalImage->store('photos', 'public');

    $journalEntry = JournalEntry::factory()->create([
        'image_path' => $path,
    ]);

    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->set('form.title', 'Updated Title, Same Image')
        ->call('submit');

    $journalEntry->refresh();

    expect($journalEntry->title)->toBe('Updated Title, Same Image');
    expect($journalEntry->image_path)->toBe($path);
});

it('redirects after saving to showJournalEntry', function () {
    $journalEntry = JournalEntry::factory()->create([
        'title' => 'First Post',
        'plant_name' => 'Yarrow',
        'notes' => 'Went on a walk and found a yellow flowering plant.',
    ]);

    Livewire::test(EditJournalEntry::class, ['journalEntry' => $journalEntry])
        ->set('form.title', 'Changing Post')
        ->call('submit')
        ->assertRedirect(route('journalEntries.show', $journalEntry));
});
