<?php

use App\Livewire\CreateJournalEntry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    Livewire::test(CreateJournalEntry::class)
        ->assertStatus(200);
});

it('creates a journal entry', function () {
    Livewire::test(CreateJournalEntry::class)
        ->set('form.title', 'My plant')
        ->set('form.plant_name', 'Daisy')
        ->set('form.notes', 'It is growing')
        ->call('submit');
    $this->assertDatabaseHas('journal_entries', ['title' => 'My plant']);
});

it('creates a journal entry with an image', function () {
    Storage::fake('public');
    Livewire::test(CreateJournalEntry::class)
        ->set('form.title', 'My plant with image')
        ->set('form.plant_name', 'Daisy')
        ->set('form.notes', 'It is growing')
        ->set('form.image', UploadedFile::fake()->image('photo.jpg'))
        ->call('submit');
    $this->assertDatabaseHas('journal_entries', ['title' => 'My plant with image']);
    expect(\App\Models\JournalEntry::first()->image_path)->not->toBeNull();
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

it('can generate any ai response and populate the plant name field', function () {
    Http::fake([
        '*/api/generate' => Http::response(['response' => 'Spider Plant'], 200),
    ]);
    Livewire::test(CreateJournalEntry::class)
        ->set('form.image', UploadedFile::fake()->image('photo.jpg'))
        ->call('generateAi')
        ->assertSet('form.plant_name', 'Spider Plant');
});
