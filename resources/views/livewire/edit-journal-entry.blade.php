<div class="container flex items-center flex-col space-y-5">
    <form wire:submit="submit">
        <flux:input type="text" wire:model="form.title" label="Title"/>
        <flux:input type="text" wire:model="form.plant_name" label="Plant Name"/>
        <flux:editor wire:model="form.notes" label="Notes"/>
        <flux:button type="submit">Submit</flux:button>
    </form>
</div>
