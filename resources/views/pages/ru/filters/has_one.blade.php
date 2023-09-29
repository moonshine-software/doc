<x-page title="HasOneFilter">

<x-extendby :href="route('moonshine.page', 'fields-has_one')">
    HasOne
</x-extendby>

<x-code language="php">
use MoonShine\Filters\HasOneFilter;

//...

public function filters(): array
{
    return [
        HasOne::make('Phone', resource: 'number')
            ->nullable()
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_has_one.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_has_one_dark.png') }}"></x-image>

</x-page>
