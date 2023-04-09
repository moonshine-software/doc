<x-page title="Url">

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
