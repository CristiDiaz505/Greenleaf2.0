<div class="container flex items-center flex-col space-y-5">
    {{-- Success is as dangerous as failure. --}}
    <flux:heading size="xl" level=1>Create a new entry</flux:heading>
        <form wire:submit="submit" class="space-y-5">
            <flux:input type="text" wire:model="form.title" label="Title"/>
            <flux:input type="text" wire:model="form.plant_name" label="Plant Name"/>
            <flux:editor wire:model="form.notes" label="Notes"/>
            <flux:input type="file" wire:model="form.image" label="Image"/>

            @if ($form->image)
                <img src="{{ $form->image->temporaryUrl() }}" class="mt-4 w-48 h-48 object-cover">
            @endif

            <div class="flex gap-4">
                <flux:button type="back" href="{{ route('journalEntries.index') }}">Back</flux:button>
                <div x-data="{ showImageError: false }" class="relative">
                    <flux:button type="button" x-on:click="$wire.form.image ? ($wire.generateAi(), showImageError = false) : showImageError = true">Generate with AI</flux:button>
                    <div x-show="showImageError" x-cloak class="absolute top-full left-0 mt-2 text-red-500 text-sm w-64 z-10">
                        You need to include an image to generate AI content.
                    </div>
                </div>
                <flux:button type="submit">Submit</flux:button>
            </div>
        </form>
</div>
