<x-page title="Slug">

<x-extendby :href="route('moonshine.page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Using this field you can generate a slug based on the selected field and keep it unique too
</x-p>

<x-code language="php">
//...
use MoonShine\Fields\Slug;

public function fields(): array
{
    return [
        Slug::make('Slug')->from('title')->separator('-')->unique(),
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/slug.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/slug_dark.png') }}"></x-image>

</x-page>
