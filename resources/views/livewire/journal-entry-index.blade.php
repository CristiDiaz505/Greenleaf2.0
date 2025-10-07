<div>
    <flux:heading class='heading'>Journal Entries</flux:heading>
   @foreach ($journalEntries as $journalEntry)
        <flux:heading level=2>
            <flux:link class="m-6" href="{{ route('journalEntries.edit', $journalEntry->id) }}">
                {{$journalEntry->title}}
            </flux:link>
        </flux:heading>
        <flux:text>{{$journalEntry->plant_name}}</flux:text>
   @endforeach
    <flux:link href="{{ route('journalEntry.create')}}" class="m-6">Create New Entry</flux:link>
</div>
