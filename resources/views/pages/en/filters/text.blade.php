<x-page title="TextFilter">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-code language="php">
use MoonShine\Filters\TextFilter;

//...

public function filters(): array
{
    return [
        TextFilter::make('Title')
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/filter_text.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/filter_text_dark.png') }}"></x-image>

</x-page>
