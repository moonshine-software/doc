<x-page title="DateFilter">

<x-extendby :href="route('moonshine.custom_page', 'fields-date')">
    Date
</x-extendby>

<x-code language="php">
use MoonShine\Filters\DateFilter;

//...

public function filters(): array
{
    return [
        DateFilter::make('Created at')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_date.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_date_dark.png') }}"></x-image>

</x-page>
