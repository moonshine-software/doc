<x-page title="Url">

<x-extendby :href="route('moonshine.custom_page', 'fields-text')">
    Text
</x-extendby>

<x-p>
    Everything is the same as the "Text Box", only the input type = url
</x-p>

<x-code language="php">
use MoonShine\Fields\Url;

Url::make('Url', 'url')
</x-code>

</x-page>
