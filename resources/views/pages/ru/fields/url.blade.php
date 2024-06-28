<x-page
    title="Url"
    :sectionMenu="[
        'Разделы' => [
            ['url' => '#basics', 'label' => 'Основы'],
            ['url' => '#title', 'label' => 'Заголовок'],
            ['url' => '#blank', 'label' => 'Blank'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-sub-title id="basics">Основы</x-sub-title>

<x-p>
    Поле <em>Url</em> является расширением <em>Text</em>,
    которое по умолчанию устанавливает <code>type=url</code>.
</x-p>

<x-code language="php">
use MoonShine\Fields\Url; // [tl! focus]

//...

public function fields(): array
{
    return [
        Url::make('Link') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="title">Заголовок</x-sub-title>

<x-p>
    Метод <code>title()</code> позволяет задать заголовок ссылки.
</x-p>

<x-code language="php">
title(Closure $callback)
</x-code>

<x-code language="php">
use MoonShine\Fields\Url;

//...

Url::make('Link')
    ->title(fn(string $url, Url $ctx) => str($url)->limit(3)) // [tl! focus]
</x-code>

<x-sub-title id="blank">Blank</x-sub-title>

<x-p>
    Метод <code>blank()</code> позволяет открывать ссылку в новом окне.
</x-p>

<x-code language="php">
blank()
</x-code>

<x-code language="php">
use MoonShine\Fields\Url;

//...

Url::make('Link')
    ->blank() // [tl! focus]
</x-code>

</x-page>
