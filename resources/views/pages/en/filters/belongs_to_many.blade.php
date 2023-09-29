<x-page title="BelongsToManyFilter">

<x-extendby :href="route('moonshine.page', 'fields-belongs_to_many')">
    BelongsToMany
</x-extendby>

<x-code language="php">
use MoonShine\Filters\BelongsToManyFilter;

//...

public function filters(): array
{
    return [
        BelongsToManyFilter::make('Categories')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_belongs_to_many.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_belongs_to_many_dark.png') }}"></x-image>

</x-page>
