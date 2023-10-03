<x-page title="BelongsToFilter">

<x-extendby :href="route('moonshine.page', 'fields-belongs_to')">
    BelongsTo
</x-extendby>

<x-code language="php">
use MoonShine\Filters\BelongsToFilter;

//...

public function filters(): array
{
    return [
        BelongsToFilter::make('Author', resource: 'name')
            ->nullable()
            ->canSee(fn() => auth('moonshine')->user()->moonshine_user_role_id === 1),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_belongs_to.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_belongs_to_dark.png') }}"></x-image>

</x-page>
