<div class="journal-entries-page min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header -->
        <div class="mb-10 md:mb-12">
            <flux:heading class="page-title">
                Journal Entries
            </flux:heading>
        </div>

        <!-- Search input -->
        <div class="mb-6 relative">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search by title or plant name..."
                class="w-full pl-4 pr-10 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            >
            <button
                x-data
                x-show="$wire.search"
                x-on:click="$wire.set('search', '')"
                type="button"
                class="absolute top-0 right-0 h-full px-3 text-gray-500 hover:text-gray-700"
                aria-label="Clear search"
                x-cloak
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div class="h-16"></div>

        <!-- Journal entry cards -->
        <div class="space-y-4 mb-10">
            @foreach ($journalEntries as $journalEntry)
                <article class="entry-card">
                    <flux:link
                        href="{{ route('journalEntries.edit', $journalEntry->id) }}"
                        class="entry-link-wrapper"
                    >
                        <div class="entry-card-content">
                            <div class="flex items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <flux:heading level="2" class="entry-title">
                                        {{$journalEntry->title}}
                                    </flux:heading>
                                    <div class="flex items-center gap-2 mt-3">
                                        <span class="plant-icon">🌿</span>
                                        <flux:text class="plant-name">
                                            {{$journalEntry->plant_name}}
                                        </flux:text>
                                    </div>
                                </div>
                                <div class="entry-arrow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </flux:link>
                </article>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="mt-4">
            {{ $journalEntries->links() }}
        </div>

        <!-- Create button -->
        <div class="text-center">
            <flux:link
                href="{{ route('journalEntry.create')}}"
                class="create-button"
            >
                Create New Entry
            </flux:link>
        </div>
    </div>
</div>
