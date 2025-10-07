<div class="container mx-auto mt-5 space-y-10">
    <flux:heading size="xl">{{ $journalEntry->title }} </flux:heading>
    {{ $journalEntry->plant_name }}
    {!! $journalEntry->notes !!}
    <flux:link href="{{ route('journalEntries.edit', $journalEntry->id) }}">Edit</flux:link>
    <flux:button wire:click="delete" variant="danger">Delete Record</flux:button>
    <flux:link href="{{ route('journalEntries.index') }}">Back</flux:link>
</div>
