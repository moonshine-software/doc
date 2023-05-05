<x-page
    title="Url"
    :videos="[
        ['url' => 'https://www.youtube.com/embed/7HGaebxlcFM?start=925&end=978', 'title' => 'Screencasts: Поле Url'],
    ]"
>

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Все то же самое как и "Текстовое поле", меняется только input type = url
</x-p>

<x-code language="php">
use MoonShine\Fields\Url;

Url::make('Url', 'url')
</x-code>

</x-page>
