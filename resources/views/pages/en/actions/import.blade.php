<x-page title="Import">

<x-p>
    Imports data
</x-p>

<x-code language="php">
use Leeto\MoonShine\Actions\ImportAction;

//...
public function actions(): array
{
    return [
        ImportAction::make('Import')
            // Optional methods
            // If you want to run in the background
            ->queue()
            // Selecting a drive
            ->disk('public')
            // Selecting a save directory
            ->dir('/exports')
            // Delete after importing
            ->deleteAfter()
        ,
    ];
}
//...
</x-code>

<x-p>
    Only those fields will be imported that are marked using the <code>useOnImport</code>
</x-p>

<x-code language="php">

//...
public function fields(): array
{
    return [
        // Be sure to mark the identifier, otherwise all entries will be added and not edited
        ID::make()
            ->useOnImport(),

        Text::make('Title')
            ->useOnImport(),
    ];
}
//...
</x-code>

</x-page>
