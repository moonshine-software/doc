<x-page
    title="Text field"
    :sectionMenu="[
        'Sections' => [
            ['url' => '#make', 'label' => 'Make'],
            ['url' => '#default', 'label' => 'Default value'],
            ['url' => '#readonly', 'label' => 'Only for reading'],
            ['url' => '#mask', 'label' => 'Mask'],
            ['url' => '#placeholder', 'label' => 'Placeholder'],
            ['url' => '#extensions', 'label' => 'Extensions'],
            ['url' => '#tags', 'label' => 'Tags'],
            ['url' => '#update-on-preview', 'label' => 'Editing in preview'],
            ['url' => '#unescape', 'label' => 'Special characters'],
        ]
    ]"
>

<x-sub-title id="make">Make</x-sub-title>

<x-p>
    The text field includes all the basic methods.
</x-p>

<x-code language="php">
use MoonShine\Fields\Text; // [tl! focus]

//...

public function fields(): array
{
    return [
        Text::make('Title')  // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/input.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/input_dark.png') }}"></x-image>

<x-sub-title id="default">Default value</x-sub-title>

<x-p>
    You can use the <code>default()</code> method if you need to specify a default value for a field.
</x-p>

<x-code language="php">
default(mixed $default)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->default('-') // [tl! focus]
    ];
}

//...
</x-code>

@include('pages.en.fields.shared.readonly', ['field' => 'Text']))

<x-sub-title id="mask">Mask</x-sub-title>

<x-p>
    The <code>mask()</code> method is used to add a mask to a field.
</x-p>

<x-code language="php">
mask(string $mask)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->mask('7 (999) 999-99-99') // [tl! focus]
    ];
}

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/mask.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/mask_dark.png') }}"></x-image>

@include('pages.en.fields.shared.placeholder', ['field' => 'Text'])

<x-sub-title id="extensions">Extensions</x-sub-title>

<x-p>There are several extensions available for the <em>Text</em> field:</x-p>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> ability to copy a value using a button</x-p>

<x-code language="php">
copy(string $value = '@{{value}}')
</x-code>

<x-ul>
    <li><code>@{{value}}</code> - field value.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy(), // [tl! focus]
        Text::make('Token')
            ->copy('https://domain.com?token=@{{value}}') // [tl! focus]
        ];
    }

//...
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> lock with change blocking</x-p>

<x-code language="php">
locked()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> disable value display</x-p>

<x-code language="php">
eye()
</x-code>

<x-p><x-moonshine::badge color="green">+</x-moonshine::badge> format hint</x-p>

<x-code language="php">
expansion(string $ext)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->copy() // [tl! focus]
            ->locked() // [tl! focus]
            ->expansion('kg') // [tl! focus]
            ->eye() // [tl! focus]
        ];
    }

//...
</x-code>

<x-image theme="light" src="{{ asset('screenshots/expansion.png') }}"></x-image>
<x-image theme="dark" src="{{ asset('screenshots/expansion_dark.png') }}"></x-image>

<x-moonshine::alert type="default" icon="heroicons.information-circle">
    The <code>copy</code> method uses the <code>Clipboard API</code> which is only available for HTTPS or localhost
</x-moonshine::alert>

<x-p>
    You can use custom extensions,
    To do this, they must be added to the field via the <code>extension()</code> method.
</x-p>

<x-code language="php">
extension(InputExtension $extension)
</x-code>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->extension(new InputCustomExtension()) // [tl! focus]
        ];
    }

//...
</x-code>

<x-sub-title id="tags">Tags</x-sub-title>

<x-p>
    The <code>tags()</code> method allows you to enter data in the form of tags.
</x-p>

<x-code language="php">
tags(?int $limit = null)
</x-code>

<x-ul>
    <li><code>$limit</code> - number of available tags, unlimited by default.</li>
</x-ul>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Keywords')
            ->tags() // [tl! focus]
        ];
    }

//...
</x-code>

@include('pages.en.fields.shared.update_on_preview', ['field' => 'Text'])

<x-sub-title id="unescape">Special characters</x-sub-title>

<x-moonshine::alert type="warning" icon="heroicons.information-circle">
    By default, the <strong>Text</strong> field and its descendants
    convert special characters into HTML entities when outputting values.
</x-moonshine::alert>

<x-p>
    The <code>unescape()</code> method allows you to undo the conversion of special characters
    in the HTML entity when outputting values.
</x-p>

<x-code language="php">
use MoonShine\Fields\Text;

//...

public function fields(): array
{
    return [
        Text::make('Title')
            ->unescape() // [tl! focus]
        ];
    }

//...
</x-code>

</x-page>
