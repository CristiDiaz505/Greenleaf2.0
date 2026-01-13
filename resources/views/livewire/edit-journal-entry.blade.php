<div class="container flex items-center flex-col space-y-5">
    <form wire:submit="submit" class="space-y-5">
        <flux:input type="text" wire:model="form.title" label="Title"/>
        <flux:input type="text" wire:model="form.plant_name" label="Plant Name"/>
        <flux:editor wire:model="form.notes" label="Notes"/>
        <flux:input type="file" wire:model="form.image" label="Image"/>

        @if ($form->image)
            <p>New Image Preview:</p>
            <img src="{{ $form->image->temporaryUrl() }}" class="mt-4 w-48 h-48 object-cover">
        @elseif ($form->image_path)
            <p>Current Image:</p>
            <img src="{{ Illuminate\Support\Facades\Storage::url($form->image_path) }}" alt="Current image" class="mt-4 w-48 h-48 object-cover">
        @endif

        <div class="flex items-right space-x-4">
            <flux:button href="{{ route('journalEntries.index') }}">Back</flux:button>
            <flux:button type="submit">Save Changes</flux:button>
            <flux:button
                type="button"
                wire:click="delete"
                wire:confirm="Are you sure you want to delete this journal entry?"
            >Delete</flux:button>
        </div>
    </form>
</div>
