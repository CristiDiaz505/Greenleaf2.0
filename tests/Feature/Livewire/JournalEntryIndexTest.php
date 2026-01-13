<?php

use App\Livewire\JournalEntryIndex;
use App\Models\JournalEntry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('lists the journal entries', function () {
    $journalEntries = JournalEntry::factory()->count(3)->sequence(
        ['title' => 'First Posting',
            'plant_name' => 'Yarrow',
            'notes' => 'Went on a walk and found a yellow flowering plant.',
        ],
        ['title' => 'Second Posting',
            'plant_name' => 'Yarrow',
            'notes' => 'Went on a walk and found a yellow flowering plant.',
        ],
        ['title' => 'Third Posting',
            'plant_name' => 'Yarrow',
            'notes' => 'Went on a walk and found a yellow flowering plant.',
        ],
    )->create();
    Livewire::test(JournalEntryIndex::class)
        ->assertSee(['First Posting', 'Second Posting', 'Third Posting']);
});

it('redirects to create journal entry after clicking create button', function () {});
