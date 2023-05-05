<x-page
    title="Slug"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=104&end=236', 'title' => 'Screencasts: Поле Slug'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    С помощью данного поля вы можете генерировать slug на основе выбранного поля, а также сохранять его уникальным
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
