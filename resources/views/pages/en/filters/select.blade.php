<x-page title="SelectFilter">

<x-extendby :href="route('moonshine.page', 'fields-select')">
    Select
</x-extendby>

<x-code language="php">
use MoonShine\Filters\SelectFilter;

//...

public function filters(): array
{
    return [
        SelectFilter::make('Country', 'country_id')
            ->options([
                'value 1' => 'Option Label 1',
                'value 2' => 'Option Label 2'
            ])
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_select.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_select_dark.png') }}"></x-image>

</x-page>
