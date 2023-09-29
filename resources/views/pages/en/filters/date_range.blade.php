<x-page title="DateRangeFilter">

<x-extendby :href="route('moonshine.page', 'fields-date')">
    Date
</x-extendby>

<x-code language="php">
use MoonShine\Filters\DateRangeFilter;

//...

public function filters(): array
{
    return [
        DateRangeFilter::make('Created at')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_date_range.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_date_range_dark.png') }}"></x-image>

</x-page>
