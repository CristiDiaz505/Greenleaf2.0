<?php

use App\Livewire\CreateJournalEntry;
use App\Livewire\EditJournalEntry;
use App\Livewire\JournalEntryIndex;
use App\Livewire\ShowJournalEntry;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/journal-entries', JournalEntryIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('journalEntries.index');

Route::get('/journal-entries/{journalEntry}', ShowJournalEntry::class)
    ->middleware(['auth', 'verified'])
    ->name('journalEntries.show');

Route::get('/journal-entries/{journalEntry}/edit', EditJournalEntry::class)
    ->middleware(['auth', 'verified'])
    ->name('journalEntries.edit');

Route::get('/create-journal-entry', CreateJournalEntry::class)
    ->middleware(['auth', 'verified'])
    ->name('journalEntry.create');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
