<div class="container mx-auto mt-5 space-y-10">
    <flux:heading size="xl">{{ $journalEntry->title }} </flux:heading>

    @if ($journalEntry->image_path)
        <div class="my-4">
            <img src="{{ Illuminate\Support\Facades\Storage::url($journalEntry->image_path) }}" alt="Image for {{ $journalEntry->title }}" class="max-w-lg w-full h-auto rounded-lg shadow-md">
        </div>
    @endif

    {{ $journalEntry->plant_name }}
    {!! $journalEntry->notes !!}
    <flux:link href="{{ route('journalEntries.edit', $journalEntry->id) }}">Edit</flux:link>
    <flux:button wire:click="delete" variant="danger">Delete Record</flux:button>
    <flux:link href="{{ route('journalEntries.index') }}">Back</flux:link>
</div>
