<x-page title="Basics" :sectionMenu="[
    'Sections' => [
        ['url' => '#filters', 'label' => 'Adding a filter'],
        ['url' => '#custom-query', 'label' => 'Custom query'],
    ]
]">

<x-sub-title id="filters">Adding a filter</x-sub-title>

<x-extendby :href="route('moonshine.custom_page', 'fields-index')">
    Fields
</x-extendby>

<x-p>
    Filters are displayed on the main page of the resource to filter data.
    They implement from the corresponding fields, so all methods of these fields are available to them.
</x-p>

<x-p>
    Filters work in exactly the same way as fields, except that they are declared in
     <code>filters</code> resource method
</x-p>

<x-code language="php">
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Filters\BelongsToManyFilter;
use MoonShine\Filters\DateRangeFilter;
use MoonShine\Filters\SlideFilter;
use MoonShine\Filters\SwitchBooleanFilter;
use MoonShine\Filters\TextFilter;

//...

public function filters(): array
{
    return [
        TextFilter::make('Title'),

        BelongsToFilter::make('Author', resource: 'name')
            ->nullable()
            ->canSee(fn() => auth('moonshine')->user()->moonshine_user_role_id === 1),

        TextFilter::make('Slug'),

        BelongsToManyFilter::make('Categories')
            ->select(),

        DateRangeFilter::make('Created at'),

        SlideFilter::make('Age')
            ->fromField('age_from')
            ->toField('age_to')
            ->min(0)
            ->max(60),

        SwitchBooleanFilter::make('Active')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filters.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filters_dark.png') }}"></x-image>

<x-sub-title id="custom-query">Custom query</x-sub-title>

<x-p>
    Using the <code>customQuery</code> method, you can create a custom query for the filter
</x-p>

<x-code language="php">
use MoonShine\Filters\DateRangeFilter;
use MoonShine\Filters\TextFilter;

//...

public function filters(): array
{
    return [
        TextFilter::make('Title')
            ->customQuery(fn(Builder $query, $value) => $query->where('title', 'LIKE', "%${value}%")), // [tl! focus]

        DateRangeFilter::make('Created at')
            ->customQuery(function (Builder $query, $values) {
                return $query
                    ->when($values['from'] ?? null, function ($query, $fromDate) {
                        $query->whereDate('created_at', '>=', Carbon::parse($fromDate));
                    })
                    ->when($values['to'] ?? null, function ($query, $toDate) {
                        $query->whereDate('created_at', '<=', Carbon::parse($toDate));
                    });
            }), // [tl! focus]
    ];
}

//...
</x-code>

</x-page>
