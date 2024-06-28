<x-page
    title="Url"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#basics', 'label' => 'Basics'],
            ['url' => '#title', 'label' => 'Title'],
            ['url' => '#blank', 'label' => 'Blank'],
        ]
    ]"
>

<x-extendby :href="to_page('fields-text')">
    Text
</x-extendby>

<x-sub-title id="basics">Basics</x-sub-title>

<x-p>
    The <em>Url</em> field is an extension of <em>Text</em>,
    which by default sets <code>type=url</code>.
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

<x-sub-title id="title">Title</x-sub-title>

<x-p>
    The <code>title()</code> method allows you to set the title of the link.
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
    The <code>blank()</code> method allows you to open a link in a new window.
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
