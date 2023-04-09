<x-page title="Export">

<x-p>
    Exports all data including filtering
</x-p>

<x-code language="php">
use MoonShine\Actions\ExportAction;

//...
public function actions(): array
{
    return [
        ExportAction::make('Export')
            // Optional methods
            // If you want to run in the background
            ->queue()
            // Selecting a drive
            ->disk('public')
            // Selecting a save directory
            ->dir('/exports')
        ,
    ];
}
//...
</x-code>

<x-p>
    Only those fields are exported that have the flag to display in the export
</x-p>

<x-code language="php">

//...
public function fields(): array
{
    return [
        ID::make()->showOnExport(),
    ];
}
//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/export.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/export_dark.png') }}"></x-image>

</x-page>
