<x-page title="Preview" :sectionMenu="[
    'Sections' => [
        ['url' => '#make', 'label' => 'Make'],
        ['url' => '#badge', 'label' => 'Badge'],
        ['url' => '#boolean', 'label' => 'Boolean'],
        ['url' => '#link', 'label' => 'Link'],
        ['url' => '#image', 'label' => 'Image'],
    ]
]">

<x-moonshine::alert class="mt-8" type="warning" icon="heroicons.information-circle">
    The field is not intended for entering/changing data!
</x-moonshine::alert>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    Using the <em>Preview</em> field you can display text data from any field in the model,
     or generate text.
</x-p>

<x-code language="php">
use MoonShine\Fields\Preview; // [tl! focus]

//...

public function fields(): array
{
    return [
        Preview::make('Preview', 'preview', static fn() => fake()->realText())  // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/preview.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/preview_dark.png') }}"></x-image>

<x-sub-title id="badge">Badge</x-sub-title>

<x-p>
    The <code>badge()</code> method allows you to display a field as an icon, for example to display the status of an order.<br/>
    The method accepts a parameter in the form of a string or closure with an icon color.
</x-p>

<x-code language="php">
badge(string|Closure|null $color = null)
</x-code>

@include('pages.ru.ui.shared.colors')

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Status')
            ->badge(fn($status, Field $field) => $status === 1 ? 'green' : 'gray') // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="boolean">Boolean</x-sub-title>

<x-p>
    The <code>boolean()</code> method allows you to display a field as a label (green or red) for boolean values.
</x-p>

<x-code language="php">
boolean(
    mixed $hideTrue = null,
    mixed $hideFalse = null
)
</x-code>

<x-p>
    The <code>hideTrue</code> and <code>hideFalse</code> parameters allow you to hide the label for values.
</x-p>

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Active')
            ->boolean(hideTrue: false, hideFalse: false) // [tl! focus]
    ];
}

//...
</x-code>

<x-sub-title id="link">Link</x-sub-title>

<x-p>
    The <code>link()</code> method allows you to display a field as a link.
</x-p>

<x-code language="php">
link(
    string|Closure $link,
    string|Closure $name = '',
    ?string $icon = null,
    bool $withoutIcon = false,
    bool $blank = false,
)
</x-code>

<x-p>
    <ul>
        <li><code>$link</code> - link url,</li>
        <li><code>$name</code> - link text,</li>
        <li><code>$icon</code> - icon name,</li>
        <li><code>$withoutIcon</code> - do not display the link icon,</li>
        <li><code>$blank</code> - open the link in a new tab.</li>
    </ul>
</x-p>

<x-moonshine::alert type="default" icon="heroicons.book-open" class="my-4">
    For more detailed information, please refer to the section
    <x-link link="{{ route('moonshine.page', 'icons') }}">Icons</x-link>.
</x-moonshine::alert>

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Link')
            ->link('https://moonshine-laravel.com', blank: false), // [tl! focus]
        Preview::make('Link')
            ->link(fn($link, Field $field) => $link, fn($name, Field $field) => 'Go') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/preview_all.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/preview_all_dark.png') }}"></x-image>

<x-sub-title id="image">Image</x-sub-title>

<x-p>
    The <code>image()</code> method allows you to transform a url into a thumbnail with an image.
</x-p>

<x-code language="php">
use MoonShine\Fields\Preview;

//...

public function fields(): array
{
    return [
        Preview::make('Thumb')
            ->image() // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/preview_image.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/preview_image_dark.png') }}"></x-image>

</x-page>
